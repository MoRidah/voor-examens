<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Exception;
use stdClass;

class ItemController extends Controller
{
    private $itemsFile;
    private $useFile = false;

    public function __construct()
    {
        //gemaakt door mohammed abbas
        $this->itemsFile = storage_path('app/items.json');
        
        // Check if we can use the database or need to fall back to file storage
        try {
            Item::count();
            $this->useFile = false;
        } catch (Exception $e) {
            $this->useFile = true;
            // Create the items.json file if it doesn't exist
            if (!File::exists($this->itemsFile)) {
                File::put($this->itemsFile, json_encode([]));
            }
        }
    }

    /**
     * Get all items from file storage as objects
     * 
     * //gemaakt door mohammed abbas
     */
    private function getItemsFromFile()
    {
        $items = json_decode(File::get($this->itemsFile), true) ?? [];
        return collect($items)->sortByDesc('created_at');
    }

    /**
     * Save items to file storage
     * 
     * //gemaakt door mohammed abbas
     */
    private function saveItemsToFile($items)
    {
        File::put($this->itemsFile, json_encode($items));
    }

    /**
     * Display a listing of the resource.
     * 
     * //gemaakt door mohammed abbas
     */
    public function index()
    {
        if ($this->useFile) {
            $allItems = $this->getItemsFromFile();
            $page = request()->get('page', 1);
            $perPage = 10;
            
            $items = $allItems->forPage($page, $perPage);
            $items = new \Illuminate\Pagination\LengthAwarePaginator(
                $items, 
                $allItems->count(), 
                $perPage, 
                $page, 
                ['path' => request()->url()]
            );
            
            return view('items.index', compact('items'));
        }
        
        $items = Item::latest()->paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * //gemaakt door mohammed abbas
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * //gemaakt door mohammed abbas
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'active' => 'boolean',
        ]);

        if ($this->useFile) {
            $items = $this->getItemsFromFile()->toArray();
            
            // Generate a new ID
            $newId = 1;
            if (!empty($items)) {
                $ids = [];
                foreach ($items as $item) {
                    $ids[] = $item['id'];
                }
                $newId = !empty($ids) ? max($ids) + 1 : 1;
            }
            
            // Create the new item
            $newItem = [
                'id' => $newId,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'active' => $request->has('active') ? 1 : 0,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
            
            // Add to items array and save
            $items[] = $newItem;
            $this->saveItemsToFile($items);
            
            return redirect()->route('items.index')
                ->with('success', 'Item created successfully.');
        }
        
        Item::create($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * //gemaakt door mohammed abbas
     */
    public function show($id)
    {
        if ($this->useFile) {
            $items = $this->getItemsFromFile();
            $item = $items->first(function($item) use ($id) {
                return $item['id'] == $id;
            });
            
            if (!$item) {
                abort(404);
            }
            
            return view('items.show', compact('item'));
        }
        
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * //gemaakt door mohammed abbas
     */
    public function edit($id)
    {
        if ($this->useFile) {
            $items = $this->getItemsFromFile();
            $item = $items->first(function($item) use ($id) {
                return $item['id'] == $id;
            });
            
            if (!$item) {
                abort(404);
            }
            
            return view('items.edit', compact('item'));
        }
        
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * //gemaakt door mohammed abbas
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'active' => 'boolean',
        ]);

        if ($this->useFile) {
            $items = $this->getItemsFromFile()->toArray();
            $found = false;
            $index = 0;
            
            // Find the item to update
            foreach ($items as $i => $item) {
                if ($item['id'] == $id) {
                    $found = true;
                    $index = $i;
                    break;
                }
            }
            
            if (!$found) {
                abort(404);
            }
            
            // Update the item
            $items[$index]['name'] = $request->name;
            $items[$index]['description'] = $request->description;
            $items[$index]['price'] = $request->price;
            $items[$index]['quantity'] = $request->quantity;
            $items[$index]['active'] = $request->has('active') ? 1 : 0;
            $items[$index]['updated_at'] = now()->toDateTimeString();
            
            // Save the updated items
            $this->saveItemsToFile($items);
            
            return redirect()->route('items.index')
                ->with('success', 'Item updated successfully.');
        }
        
        $item = Item::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * //gemaakt door mohammed abbas
     */
    public function destroy($id)
    {
        if ($this->useFile) {
            $items = $this->getItemsFromFile()->toArray();
            $found = false;
            $index = 0;
            
            // Find the item to delete
            foreach ($items as $i => $item) {
                if ($item['id'] == $id) {
                    $found = true;
                    $index = $i;
                    break;
                }
            }
            
            if (!$found) {
                abort(404);
            }
            
            // Remove the item
            unset($items[$index]);
            
            // Re-index the array
            $items = array_values($items);
            
            // Save the updated items
            $this->saveItemsToFile($items);
            
            return redirect()->route('items.index')
                ->with('success', 'Item deleted successfully.');
        }
        
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }
}
