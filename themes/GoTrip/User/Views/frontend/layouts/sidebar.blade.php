<?php
$dataUser = Auth::user();
$menus = [
    'dashboard'       => [
        'url'        => route("vendor.dashboard"),
        'title'      => __("Dashboard"),
        'icon'       => 'fa fa-home',
        'permission' => 'dashboard_vendor_access',
        'position'   => 10
    ],
    'booking-history' => [
        'url'      => route("user.booking_history"),
        'title'    => __("Booking History"),
        'icon'     => 'fa fa-clock-o',
        'position' => 20
    ],
    "wishlist"=>[
        'url'   => route("user.wishList.index"),
        'title' => __("Wishlist"),
        'icon'  => 'fa fa-heart-o',
        'position' => 21
    ],
    'profile'         => [
        'url'      => route("user.profile.index"),
        'title'    => __("My Profile"),
        'icon'     => 'fa fa-cogs',
        'position' => 95
    ],
    'password'        => [
        'url'      => route("user.change_password"),
        'title'    => __("Change password"),
        'icon'     => 'fa fa-lock',
        'position' => 95
    ],
    'admin'           => [
        'url'        => route('admin.index'),
        'title'      => __("Admin Dashboard"),
        'icon'       => 'icon ion-ios-ribbon',
        'permission' => 'dashboard_access',
        'position'   => 100
    ]
];

// Modules
$custom_modules = \Modules\ServiceProvider::getActivatedModules();
if(!empty($custom_modules)){
    foreach($custom_modules as $module){
        $moduleClass = $module['class'];
        if(class_exists($moduleClass))
        {
            $menuConfig = call_user_func([$moduleClass,'getUserMenu']);
            if(!empty($menuConfig)){
                $menus = array_merge($menus,$menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass,'getUserSubMenu']);
            if(!empty($menuSubMenu)){
                foreach($menuSubMenu as $k=>$submenu){
                    $submenu['id'] = $submenu['id'] ?? '_'.$k;
                    if(!empty($submenu['parent']) and isset($menus[$submenu['parent']])){
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

// Plugins Menu
$plugins_modules = \Plugins\ServiceProvider::getModules();
if(!empty($plugins_modules)){
    foreach($plugins_modules as $module){
        $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
        if(class_exists($moduleClass))
        {
            $menuConfig = call_user_func([$moduleClass,'getUserMenu']);
            if(!empty($menuConfig)){
                $menus = array_merge($menus,$menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass,'getUserSubMenu']);
            if(!empty($menuSubMenu)){
                foreach($menuSubMenu as $k=>$submenu){
                    $submenu['id'] = $submenu['id'] ?? '_'.$k;
                    if(!empty($submenu['parent']) and isset($menus[$submenu['parent']])){
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

// Custom Menu
$custom_modules = \Custom\ServiceProvider::getModules();
if(!empty($custom_modules)){
    foreach($custom_modules as $module){
        $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
        if(class_exists($moduleClass))
        {
            $menuConfig = call_user_func([$moduleClass,'getUserMenu']);
            if(!empty($menuConfig)){
                $menus = array_merge($menus,$menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass,'getUserSubMenu']);
            if(!empty($menuSubMenu)){
                foreach($menuSubMenu as $k=>$submenu){
                    $submenu['id'] = $submenu['id'] ?? '_'.$k;
                    if(!empty($submenu['parent']) and isset($menus[$submenu['parent']])){
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

$currentUrl = url(Illuminate\Support\Facades\Route::current()->uri());
if (!empty($menus))
    $menus = array_values(\Illuminate\Support\Arr::sort($menus, function ($value) {
        return $value['position'] ?? 100;
    }));
    foreach ($menus as $k => $menuItem) {
        if (!empty($menuItem['permission']) and !Auth::user()->hasPermission($menuItem['permission'])) {
            unset($menus[$k]);
            continue;
        }
        $menus[$k]['class'] = $currentUrl == url($menuItem['url']) ? 'active -is-active text-blue-1' : '';
        if (!empty($menuItem['children'])) {
            $menus[$k]['class'] .= ' has-children';
            foreach ($menuItem['children'] as $k2 => $menuItem2) {
                if (!empty($menuItem2['permission']) and !Auth::user()->hasPermission($menuItem2['permission'])) {
                    unset($menus[$k]['children'][$k2]);
                    continue;
                }
                $menus[$k]['children'][$k2]['class'] = $currentUrl == url($menuItem2['url']) ? 'active active_child' : '';
            }
        }
    }
?>
<div class="dashboard__sidebar bg-white scroll-bar-1">

    <div class="sidebar__user text-center mb-20">
        <div class="logo">
            @if($avatar_url = $dataUser->getAvatarUrl())
                <div class="avatar avatar-cover" style="background-image: url('{{$dataUser->getAvatarUrl()}}')"></div>
            @else
                <span class="avatar-text">{{ucfirst($dataUser->getDisplayName()[0])}}</span>
            @endif
        </div>
        <div class="user-profile-info">
            <div class="info-new">
                <span class="role-name badge badge-info">{{$dataUser->role_name}}</span>
                <h5 class="text-16">{{$dataUser->getDisplayName()}}</h5>
                <p class="text-10 mb-0">{{ __("Member Since :time",["time"=> date("M Y",strtotime($dataUser->created_at))]) }}</p>
            </div>
        </div>
        @if(!Auth::user()->hasPermission("dashboard_vendor_access") and setting_item('vendor_enable'))
        <div class="user__profile-plan mt-10 text-center">
            <a class="become-vendor button -sm -dark-1 bg-blue-1 text-white" href="{{ route("user.upgrade_vendor") }}">{{ __("Become a vendor") }}</a>
        </div>
        @endif
    </div>

    <div class="sidebar -dashboard">
        @foreach($menus as $menuItem)
            <div class="sidebar__item" data-position="{{$menuItem['position'] ?? 0}}">
                <div class="accordion -db-sidebar js-accordion">
                    <div class="accordion__item">
                        <div class="accordion__button">
                            <div class="sidebar__button {{$menuItem['class']}} col-12 d-flex items-center justify-between">
                                <div class="d-flex items-center text-15 lh-1 fw-500">
                                    @if(!empty($menuItem['icon']))
                                        <a href="{{ url($menuItem['url']) }}" class="icon text-center mr-15 text-24"><i class="{{$menuItem['icon']}}"></i></a>
                                    @endif
                                    <a href="{{ url($menuItem['url']) }}">
                                        {!! clean($menuItem['title']) !!}
                                    </a>
                                </div>
                                @if(!empty($menuItem['children']))
                                    <div class="icon-chevron-sm-down text-7"></div>
                                @endif
                            </div>
                        </div>
                        @if(!empty($menuItem['children']))
                            <div class="accordion__content">
                                <ul class="list-disc pt-15 pb-5 pl-40">
                                    @foreach($menuItem['children'] as $menuItem2)
                                        <li class="{{$menuItem2['class']}}">
                                            <a href="{{ url($menuItem2['url']) }}">
                                                @if(!empty($menuItem2['icon']))
                                                    <i class="{{$menuItem2['icon']}}"></i>
                                                @endif
                                                {!! clean($menuItem2['title']) !!}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
            <div class="sidebar__item ">
                <form id="logout-form-vendor" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-vendor').submit();" class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
                    <i class="fa fa-sign-out icon text-center mr-15 text-24"></i> {{__("Log Out")}}
                </a>
            </div>
            <div class="sidebar__item ">
                <a href="{{url('/')}}" class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
                    <i class="fa fa-long-arrow-left icon text-center mr-15 text-24"></i> {{__("Back to Homepage")}}
                </a>
            </div>
    </div>
</div>
