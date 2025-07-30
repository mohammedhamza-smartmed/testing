<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Models\User;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function assign(Request $request, $roleId)
    {
        $valid = $request->validate([
            'permessions' => 'required|array',
        ]);

        $role = roles::with('permessions')->find($roleId);

        $role->permessions()->syncWithoutDetaching($valid['permessions']);


        return response()->json([
            'message' => 'permession aded successfully',
            'role' => $role->name,
            'permissions' => $role->permessions()->pluck('name'),
        ], 200);
    }

    public function update(Request $request, roles $role)
    {
        // safer than find()

        $valid = $request->validate([
            'name' => ['required', 'string'],
            'permessions' => ['required', 'array'],
        ]);
        $role->permessions()->syncWithoutDetaching($valid['permessions']);
        $role->update($valid);

        return response()->json(['message' => 'Role updated successfully']);
    }

    public function updateUser(User $user, Request $request)
    {

        $valid = $request->validate([
            'name' => ['required', 'string'],
            'roles' => ['required', 'array'],

        ]);
        $user->roles()->syncWithoutDetaching($valid['roles']);
        $user->update($valid);
        return $user;
    }
}
