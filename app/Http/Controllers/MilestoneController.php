<?php

namespace App\Http\Controllers;

use App\{
    Alumnus, Education, Occupation, User
};

class MilestoneController extends Controller
{
    /**
     * Show all milestones
     *
     * @param User $user
     * @param Alumnus $alumnus
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user, Alumnus $alumnus)
    {
        $educations = Education::where('alumni_id', $alumnus->id)->get();
        $occupations = Occupation::where('alumni_id', $alumnus->id)->get();
        return view('users.alumni.milestones.index', compact('user','alumnus', 'educations', 'occupations'));
    }
}
