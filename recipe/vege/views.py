from pyexpat.errors import messages
from django.contrib import messages
from django.shortcuts import redirect, render
from vege.models import *
from django.contrib.auth.models import User
from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.decorators import login_required
   

@login_required(login_url="/login/")
def recipes(request):

    if request.method == "POST":
        data = request.POST

        receipe_name = data.get('recipeName')
        receipe_descriptions = data.get('recipeDescription')
        receipe_image = request.FILES.get('recipeImage')

        print(receipe_name)
        print(receipe_descriptions)

        Recipe.objects.create(
            recipe_name = receipe_name,
            recipe_Desciption = receipe_descriptions,
            recipe_Image = receipe_image
        )
        return redirect('/recipes/')

        
    queryset = Recipe.objects.all()

    if request.GET.get('search'):
        queryset = queryset.filter(recipe_name__icontains = request.GET.get('search'))


    context = {'recipes': queryset,'page':"Home"}
    
    # contexts = {'page':"Home"}
    return render(request, "home/recipe.html", context)

def update_recipe(request,id):

    queryset = Recipe.objects.get(id=id)

    if request.method == "POST":
        data = request.POST

        receipe_name = data.get('recipeName')
        receipe_descriptions = data.get('recipeDescription')
        receipe_image = request.FILES.get('recipeImage')

        queryset.recipe_name = receipe_name
        queryset.recipe_Desciption = receipe_descriptions

        if receipe_image:
            queryset.recipe_Image = receipe_image

        queryset.save()
        return redirect('/recipes/')


    context = {'recipe': queryset, 'page' : "Update Recipe"}
    return render(request,"home/update_recipe.html",context)


def delete_recipe(request,id):
    queryset = Recipe.objects.get(id=id)
    queryset.delete()
    return redirect('/recipes/')


def login_page(request):

    if request.method == "POST":    
        username = request.POST.get('username')
        password = request.POST.get('password')

        if not User.objects.filter(username = username).exists():
            messages.info(request,"Invalid Username")
            return redirect('/login/')
        
        user = authenticate(username = username, password = password)

        if user is None:
            messages.info(request,"Invalid Password..")
            return redirect('/login/')

        else:
            login(request,user)
            return redirect('/recipes/')
           
    return render(request,"home/login.html")

def logout_page(request):
    logout(request)
    return redirect('/login/')

def register(request):

    if request.method == "POST":
        
        first_name = request.POST.get('firstname')
        last_name = request.POST.get('lastname')
        username = request.POST.get('username')
        password = request.POST.get('password')

        # Check if the username already exists
        if User.objects.filter(username=username).exists():
            messages.info(request, "User already registered.")
            return redirect('/register/')
        
        # Create a new user
        user = User.objects.create(
            first_name=first_name,
            last_name=last_name,
            username=username
        )

        user.set_password(password)
        user.save()
        messages.info(request, "Account created successfully.")
        return redirect('/login/')  # Redirect to login page after successful registration

    return render(request, 'home/register.html')