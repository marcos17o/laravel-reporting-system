Route::get('/test', function () {
    
    // return Role::create([
    //         'name' => 'Admin',
    //         'slug' => 'admin',
    //         'description' => 'Administrator',
    //         'full-aaccess' => 'yes'
    //     ]);

    // return Role::create([
    //     'name' => 'Gusts',
    //     'slug' => 'guest',
    //     'description' => 'guest',
    //     'full-aaccess' => 'no'
    // ]);

    // return Role::create([
    //     'name' => 'test',
    //     'slug' => 'test',
    //     'description' => 'test',
    //     'full-aaccess' => 'no'
    // ]);

    // $user = User::find(1);
    // $user->roles()->attach([1,2,3]);
    // $user->roles()->detach([3]);
    // $user->roles()->sync([1,2]);

    // return $user->roles;

    $role = Role::find(1);
 
    // $role->roles()->sync([1,2]);

    return $role->permission;


});