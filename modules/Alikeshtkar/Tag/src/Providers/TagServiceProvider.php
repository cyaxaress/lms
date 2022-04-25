<?php

namespace Alikeshtkar\Tag\Providers;

use Alikeshtkar\Tag\Models\Tag;
use Alikeshtkar\Tag\Policies\TagPolicy;
use Alikeshtkar\Tag\View\Components\TagSelect;
use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
{
    private $moduleNamespaceLower = 'tag';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->_loadMigrations();
        $this->_loadViews();
        $this->_loadComponents();
        $this->_mergeConfigFrom();
        $this->_registerPolicies();
        $this->_pushSidebar();
    }

    /**
     * Load migrations from specified path.
     *
     * @return void
     */
    private function _loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    /**
     * Load views from specified path.
     *
     * @return void
     */
    private function _loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', $this->moduleNamespaceLower);
    }

    /**
     * Load components from specified path.
     *
     * @return void
     */
    private function _loadComponents(): void
    {
//        Blade::componentNamespace('Alikeshtkar\\Tag\\View\\Components',$this->moduleNamespaceLower);
        $this->loadViewComponentsAs($this->moduleNamespaceLower, [TagSelect::class]);
    }

    /**
     * @return void
     */
    private function _mergeConfigFrom(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/tag.php', $this->moduleNamespaceLower);
    }

    /**
     * @return void
     */
    private function _pushSidebar(): void
    {
        config()->set('sidebar.items.tags', [
            "icon" => "i-tags",
            "title" => "برچسب‌ها",
            "route_name" => 'tags.index',
            "permission" => Permission::PERMISSION_MANAGE_TAGS
        ]);
    }

    /**
     * @return void
     */
    private function _registerPolicies(): void
    {
        Gate::policy(Tag::class, TagPolicy::class);
    }
}
