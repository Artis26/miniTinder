<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class UserController extends Controller {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function create(Request $request): RedirectResponse {

        $path = $request->file('picture')->store('pictures',['disk' => 'public']);
        $img = Image::make($request->file('picture'))
            ->resize(320, 250);

        $img->save('storage/'.$request->file('picture')->store('small',['disk' => 'public']));

        $smallPath = explode("/", $img->basePath());
        unset($smallPath[0]);
        $smallPath = implode("/", $smallPath);

        DB::table('user_pictures')->insert(['user_id' => auth()->id(), 'picture_path' => $path, 'small_picture_path' => $smallPath]);

        UserProfile::create([
            'user_id' => auth()->id(),
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'gender' => $request->get('gender'),
            'age' => $request->get('age'),
            'country' => $request->get('country'),
            'city' => $request->get('city'),
            'profile_picture' => $smallPath,
            'description' => $request->get('description')
        ]);

        Filter::create([
            'user_id' => auth()->id(),
            'min_age' => 18,
            'max_age' => 119,
            'gender' => $request->get('gender'),
            'country' => $request->get('country'),
            'city' => $request->get('city')
        ]);

        return redirect('/');
    }

    public function index(): view {
        $user = UserProfile::all()->where('user_id', auth()->id())->firstOrFail();
        $pictures = DB::table('user_pictures')->select('small_picture_path')->where(['user_id' => auth()->id()])->get();

        $path = [];
        if ($pictures->count() < 1) {
            $path[] = "default/no-user-image-icon-27.jpg";
        } else {
            foreach ($pictures as $picture) {
                $path[] = $picture->small_picture_path;
            }
        }

        return view('/user/user', [
            'user' => $user,
            'pictures' => $path,
        ]);
    }

    public function searchForMatches(): view {
        $userFilters = Filter::where('user_id', auth()->id())->firstOrFail();
        $users = UserProfile::all()
            ->except(['user_id' => auth()->id()])
            ->whereBetween('age', [$userFilters->min_age, $userFilters->max_age]);

        if ($userFilters->gender != 'Both') {
            $users = $users->where('gender', $userFilters->gender);
        }
        if ($userFilters->country != 'None') {
            $users = $users->where('country', $userFilters->country);
        }
        if ($userFilters->city != 'None') {
            $users = $users->where('city', $userFilters->city);
        }

        foreach ($users as $key => $user) {
            $exist = DB::table('likes')->where(['user_id' => auth()->id(), 'liked_user_id' => $user['id']])->first();
            if ($exist !== null) {
                $users->forget($key);
            }

            $exist = DB::table('dislikes')->where(['user_id' => auth()->id(), 'disliked_user_id' => $user['id']])->first();
            if ($exist !== null) {
                $users->forget($key);
            }

            $exist = DB::table('matches')->where(['user_id' => auth()->id(), 'match_id' => $user['id']])->first();
            if ($exist !== null) {
                $users->forget($key);
            }
        }

        return view('/matches', [
            'users' => $users
        ]);

    }

    public function swipeRight(string $data): RedirectResponse {
        $user = DB::table('likes')->where(['liked_user_id' => auth()->id(), 'user_id' => $data])->first();

        if ($user !== null) {
            DB::table('likes')->where(['liked_user_id' => auth()->id(), 'user_id' => $data])->delete();
            DB::table('matches')->insert(['user_id' => auth()->id(), 'match_id' => $data]);
            return redirect('/');
        }

        DB::table('likes')->insert(['user_id' => auth()->id(), 'liked_user_id' => $data]);
        return redirect()->back();

    }

    public function swipeLeft(string $data): RedirectResponse {
        DB::table('dislikes')->insert(['user_id' => auth()->id(), 'disliked_user_id' => $data]);

        return redirect()->back();
    }

    public function myMatches(): view {
        $matches = DB::table('user_profiles')
            ->join('matches', 'user_profiles.user_id', '=', 'matches.match_id')
            ->select('user_profiles.*')
            ->get();

        return view('/matches', [
            'matches' => $matches
        ]);
    }

    public function edit(): view {
        $user = UserProfile::all()->where('user_id', auth()->id())->firstOrFail();

        return view('user/edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request): RedirectResponse {
        $user = UserProfile::where('user_id', auth()->id())->first();
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->gender = $request->input('gender');
        $user->age = $request->input('age');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->update();

        return redirect('/user');
    }

    public function updateFilters(Request $request):RedirectResponse {
        $filter = Filter::where('user_id', auth()->id())->first();
        $filter->min_age = $request->input('min_age');
        $filter->max_age = $request->input('max_age');
        $filter->gender = $request->input('gender');
        $filter->country = $request->input('country');
        $filter->city = $request->input('city');
        $filter->update();

        return redirect('/');
    }
}
