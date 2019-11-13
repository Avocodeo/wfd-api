<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Inventory;

class MealListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $meals =
//            DB::table('ingredient_recipe')
//                ->select('recipes.name', 'ingredients.name')
//                ->selectRaw("CASE WHEN ingredient_recipe.quantity >= inventories.quantity THEN 1 ELSE 0 END AS enough")
//                ->join('inventories', 'ingredient_recipe.ingredient_id', '=', 'inventories.ingredient_id')
//                ->join('recipes', 'ingredient_recipe.recipe_id', '=', 'recipes.id')
//                ->join('ingredients', 'ingredient_recipe.ingredient_id', '=', 'ingredients.id')
//                ->toSql();
        DB::select(
            "SELECT ingredient_recipe.id, recipes.name, ingredients.name as ingredient_name,
                CASE 
                    WHEN ingredient_recipe.quantity >= inventories.quantity THEN 'Yes'
                    ELSE 'No'
                END AS enough
                from wfd.ingredient_recipe
                INNER JOIN wfd.recipes
                    ON ingredient_recipe.recipe_id = recipes.id
                INNER JOIN wfd.ingredients
                    ON ingredient_recipe.ingredient_id = ingredients.id
                INNER JOIN inventories
                    ON inventories.ingredient_id = ingredient_recipe.ingredient_id
                ");

        return $meals;
    }
}
