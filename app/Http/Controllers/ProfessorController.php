<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;
use DB;

class ProfessorController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.professor.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:professors,email'
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'subject' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Veuillez entrer une adresse email valide',
            'email.unique' => 'Cette adresse email est déjà utilisée',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
            'subject.required' => 'La matière enseignée est obligatoire',
        ]);

        try {
            DB::beginTransaction();

            $professor = Professor::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'subject' => $validated['subject'],
            ]);

            DB::commit();

            auth('professor')->login($professor);

            return redirect()
                ->route('home') 
                ->with('success', 'Inscription réussie! Bienvenue.');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Registration Error: '.$e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.']);
        }
    }

    public function showLoginForm()
    {
        return view('auth.professor.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth('professor')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth('professor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function home()
    {
        return view('professor.home');
    }

    public function addClass(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'groupe' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        try {
            $course = new Course();
            $course->date = $validated['date'];
            $course->groupe = $validated['groupe'];
            $course->course_name = $validated['course_name'];
            $course->details = $validated['details'];
            $course->professor_id = Auth::id(); 
            $course->save();

            return back()->with('success', 'Les informations du cours ont été ajoutées avec succès!');
        } catch (\Exception $e) {
            Log::error('Error saving class information: ' . $e->getMessage());

            return back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }

    public function viewCahier()
    {
        $classes = Course::where('professor_id', Auth::id())->get();

        return view('professor.cahier', compact('classes'));
    }
}
