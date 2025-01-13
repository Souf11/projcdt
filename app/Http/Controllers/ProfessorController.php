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
    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.professor.register');
    }

    // Handle professor registration
    public function register(Request $request)
    {
        // Enhanced validation
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
            // Custom error messages in French
            'name.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Veuillez entrer une adresse email valide',
            'email.unique' => 'Cette adresse email est déjà utilisée',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
            'subject.required' => 'La matière enseignée est obligatoire',
        ]);

        // Begin database transaction to ensure integrity
        try {
            DB::beginTransaction();

            // Create new professor
            $professor = Professor::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'subject' => $validated['subject'],
            ]);

            // Commit the transaction if successful
            DB::commit();

            // Auto-login after registration
            auth('professor')->login($professor);

            // Redirect with success message
            return redirect()
                ->route('home') 
                ->with('success', 'Inscription réussie! Bienvenue.');

        } catch (\Exception $e) {
            // Rollback the transaction in case of any error
            DB::rollBack();

            // Log the error for debugging
            Log::error('Registration Error: '.$e->getMessage());

            // Provide a more detailed error message to the user
            return back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.']);
        }
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.professor.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate login inputs
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login with provided credentials
        if (auth('professor')->attempt($credentials)) {
            // Regenerate session if login is successful
            $request->session()->regenerate();

            // Redirect to the correct home page (general home route)
            return redirect()->route('home');
        }

        // Redirect back with error message on login failure
        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    // Handle logout request
    public function logout(Request $request)
    {
        // Log out the professor
        auth('professor')->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to home page after logout
        return redirect('/');
    }

    // Show professor's home page
    public function home()
    {
        return view('professor.home');
    }

    // Add class information to the database
    public function addClass(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'date' => 'required|date',
            'groupe' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        try {
            // Create a new Course (class) entry
            $course = new Course();
            $course->date = $validated['date'];
            $course->groupe = $validated['groupe'];
            $course->course_name = $validated['course_name'];
            $course->details = $validated['details'];
            $course->professor_id = Auth::id(); // Use the authenticated professor's ID
            $course->save();

            // Flash success message and stay on the same page
            return back()->with('success', 'Les informations du cours ont été ajoutées avec succès!');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error saving class information: ' . $e->getMessage());

            // Flash error message and stay on the same page
            return back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }

    // View the Cahier de Texte (list of classes)
    public function viewCahier()
    {
        // Retrieve the classes for the authenticated professor
        $classes = Course::where('professor_id', Auth::id())->get();

        // Return the view with the classes
        return view('professor.cahier', compact('classes'));
    }
}
