{{-- This file is included at the top of each theme to handle preview mode --}}
@php
    // In preview mode, create a mock menu object to prevent DB query errors
    if (isset($isPreview) && $isPreview && (!isset($menu) || $menu === null)) {
        $menu = (object)[
            'uid' => 0,
            'about' => 1,
            'services' => 1,
            'qualification' => 1,
            'portfolio' => 1,
            'photo' => 1,
            'video' => 1,
            'product' => 1,
            'social' => 1,
            'thoughts' => 1,
        ];
    }

    // Suppress DB errors in preview mode
    if (isset($isPreview) && $isPreview) {
        try {
            if (!isset($menu) && isset($userdata->id)) {
                $menu = DB::table('profile_menu')->where('uid', $userdata->id)->first();
            }
        } catch (\Exception $e) {
            // Silently fail in preview mode
        }
    }
@endphp
