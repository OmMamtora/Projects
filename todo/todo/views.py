from django.shortcuts import render,redirect
from pyexpat.errors import messages
from django.contrib import messages
from django.contrib.auth.models import User
from todo.models import *
from django.contrib.auth import authenticate,login,logout
from django.contrib.auth.decorators import login_required
from django.core.exceptions import ObjectDoesNotExist


def signup(request):
    if request.method == 'POST':
        username = request.POST.get('uname')
        email = request.POST.get('email')
        password = request.POST.get('password')

        # Check for duplicate username or email
        if User.objects.filter(username=username).exists():
            messages.error(request, "Username already exists.")
            return redirect('/signup/')
        if User.objects.filter(email=email).exists():
            messages.error(request, "Email already registered.")
            return redirect('/signup/')

        # Create a new user and set password
        user = User.objects.create(
            username=username,
            email=email,
        )
        user.set_password(password)  # Hash the password
        user.save()
        messages.success(request, "Account created successfully.")
        return redirect('/login/')
    
    return render(request, 'signup.html')
 
def login_page(request):
    
    if request.method == "POST":    
        username = request.POST.get('uname')
        password = request.POST.get('password')

        if not User.objects.filter(username = username).exists():
            messages.info(request,"Invalid Username")
            return redirect('/login/')
        
        user = authenticate(username = username, password = password)

        if user is None:
            messages.error(request, "Invalid  Password")
            return redirect('/login/')
        else:
            login(request, user)

            # Confirm user login
            print(f"User {user.username} is authenticated: {user.is_authenticated}")

            return redirect('/todo/')

    return render(request, 'login.html')

@login_required(login_url="/login/")
def todo(request):
    if request.method == 'POST':
        title = request.POST.get('title')
        print(title)

        if title:
            # Create a new Todo object linked to the logged-in user
            obj = Todoo(title=title, user=request.user)
            obj.save()
            messages.success(request, "Todo added successfully.")
        else:
            messages.error(request, "Todo title cannot be empty.")
        
        # Fetch all todos for the logged-in user
        res = Todoo.objects.filter(user=request.user).order_by('-date')

        # Redirect to the same page after saving
        return redirect('/todo')

    res = Todoo.objects.filter(user=request.user).order_by('-date')

    return render(request, 'todo.html', {'res': res})

@login_required(login_url="/login/")
def edit(request, srno):
    try:
        # Fetch the specific Todo object by srno
        obj = Todoo.objects.get(srno=srno)

    except ObjectDoesNotExist:
        # Handle the case where the object does not exist
        return redirect('/todo')

    if request.method == "POST":
        title = request.POST.get('title')

        if title:
            obj.title = title
            obj.save()
            messages.success(request, "Todo edited successfully..")
        else:
            messages.error(request, "Todo title cannot be empty..")

        return redirect('/todo')

    # Render the edit form page with the current Todo object
    return render(request, 'edit_todo.html', {'todo': obj})

@login_required(login_url="/login/")
def delete(request,srno):
        obj = Todoo.objects.get(srno = srno)
        obj.delete()
        messages.success(request, "Todo deleted successfully.")
    
        return redirect('/todo/')

def logout_page(request):
    logout(request)
    return redirect('/login/')