<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Show Admin Login Form
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    // Handle Admin Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Hardcoded admin credentials (for testing only, consider using a database model in production)
        if ($credentials['username'] === 'admin' && $credentials['password'] === 'emsi1') {
            Auth::guard('admin')->loginUsingId(1); // Assuming admin user ID is 1
            return redirect()->route('admin.home');
        }

        // If credentials don't match, redirect back with error
        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    // Admin Home (dashboard)
    public function home()
    {
        // Fetch professors with their courses
        $professors = Professor::with('courses')->get();
        return view('auth.admin.professors_and_classes', compact('professors')); // Correct view path
    }

    // Admin Logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Managing Professors (CRUD Operations)
    public function indexProfessors()
    {
        $professors = Professor::all();
        // Update this line to point to the correct view location (professors_and_classes)
        return view('auth.admin.professors_and_classes', compact('professors')); // Correct view path
    }

    public function createProfessor()
    {
        return view('admin.professors.create');
    }

    public function storeProfessor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:professors,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Professor::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Redirect to the professors_and_classes view after successful addition
        return redirect()->route('admin.professors.index')->with('success', 'Professor added successfully!');
    }

    public function editProfessor(Professor $professor)
    {
        return view('admin.professors.edit', compact('professor'));
    }

    public function updateProfessor(Request $request, Professor $professor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:professors,email,' . $professor->id,
        ]);

        // Only update the password if it is provided
        $professor->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            // Check if password is present and update it
            'password' => $request->filled('password') ? Hash::make($request->input('password')) : $professor->password,
        ]);

        // Redirect to the professors_and_classes view after update
        return redirect()->route('admin.professors.index')->with('success', 'Professor updated successfully!');
    }

    // Deleting a professor and keeping the admin on the same page
    public function destroyProfessor(Professor $professor)
    {
        // Deleting the professor
        $professor->delete();

        // Redirect back to the professors list with success message
        return redirect()->route('admin.professors.index')->with('success', 'Professor deleted successfully!');
    }

    // Managing Courses (CRUD Operations)
    public function indexCourses()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function createCourse()
    {
        $professors = Professor::all(); // Get all professors to associate a course
        return view('admin.courses.create', compact('professors'));
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'groupe' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'details' => 'required|string',
            'professor_id' => 'required|exists:professors,id', // Make sure professor is valid
        ]);

        Course::create([
            'date' => $validated['date'],
            'groupe' => $validated['groupe'],
            'course_name' => $validated['course_name'],
            'details' => $validated['details'],
            'professor_id' => $validated['professor_id'],
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course added successfully!');
    }

    public function editCourse(Course $course)
    {
        $professors = Professor::all(); // Get all professors to associate a course
        return view('admin.courses.edit', compact('course', 'professors'));
    }

    public function updateCourse(Request $request, Course $course)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'groupe' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'details' => 'required|string',
            'professor_id' => 'required|exists:professors,id', // Make sure professor is valid
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
    }

    // Deleting a course and keeping the admin on the same page
    public function destroyCourse(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'Course deleted successfully!');
    }
}
