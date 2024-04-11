<?php

namespace Cyaxaress\Category\Database\Seeds;

use Cyaxaress\Category\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => __('uncategorized'),
                'slug' => 'uncategorized',
            ],
            [
                'title' => __('programming'),
                'slug' => 'programming',
                'categories' => [
                    [
                        'title' => __('web'),
                        'slug' => 'web-programming',
                        'categories' => [
                            [
                                'title' => __('laravel'),
                                'slug' => 'laravel',
                            ],
                            [
                                'title' => __('react'),
                                'slug' => 'react-js',
                            ],
                        ],
                    ],
                    [
                        'title' => __('mobile'),
                        'slug' => 'mobile-programming',
                    ],
                ],
            ],
            [
                'title' => __('graphic'),
                'slug' => 'graphic',
                'categories' => [
                    [
                        'title' => __('user-interface'),
                        'slug' => 'desgin-user-interface',
                    ],
                ],
            ],
            [
                'title' => __('language'),
                'slug' => 'language',
            ],
            [
                'title' => __('business-management'),
                'slug' => 'business-management',
                'categories' => [
                    [
                        'title' => __('product-management'),
                        'slug' => 'product-management',
                    ],
                    [
                        'title' => __('project-management'),
                        'slug' => 'project-management',
                    ],
                ],
            ],
        ];
        foreach ($categories as $category) {
            $this->create($category);
        }
    }

    public function create($category, $parentId = null)
    {
        $parent = Category::firstOrCreate(
            [
                'parent_id' => $parentId,
                'title' => $category['title'],
                'slug' => $category['slug'],
            ],
            []
        );
        if (array_key_exists('categories', $category)) {
            foreach ($category['categories'] as $subCategory) {
                $this->create($subCategory, $parent->id);
            }
        }
    }
}
