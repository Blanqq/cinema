# Cinema

Application to make reservations for cinema shows.

#Credentials to Demo

Admin account:  
u: admin@example.com  
p: admin

Employee account:  
u: employee@example.com  
p: employee

User account:  
u: user@example.com  
p: user  

#Whats already done.

##Main page
Landing page with Vue component, who lets user to select his cinema from list of all cinemas from network of cinemas. It also gives possibility to choose, do the user want to register or just view movies shown in cinema. If the list of cinemas is empty add new cinema through Employee -> cinema management panel.

##Admin Panel
To get access to admin panel you need to login as user with admin role(credentials in paragraph above).
###Role management
In role management panel you can see all roles, add new role, delete and edit role details like name.
All this features are implemented, but for now delete and edit actions are disabled, to prevent deleting admin and employee role.
###User management
In user management panel you can see details of users(email address, when account was created, what roles user have).
By clicking "Manage" button you can access user detail panel, where in form you can change user roles, by checking checkboxes.

##Employee Panel
To access to employee panel you need to login as user with admin or employee role.

###Genre management
CRUD to manage genres of the movies.
###Movie management
CRUD to manage movies. By clicking on name of the movie, you are redirected to movie database page where you can see more details about the movie, and add posters, start discussion about movie(still TODO).
###Cinema management
CRUD to mange cinemas  
Here you can see list of the cinemas.By clicking "Manage" button, you will be redirected to specified cinema management panel.
####Specified cinema management panel
Here you can see information about specified cinema,you can also see list of rooms in this specified cinema, and add new rooms.  
By clicking on "Manage" button you will be redirected to Seats Panel where you can make CRUD operations on Seats for specified room.  
By clicking on "Mange shows in this cinema" button, you will be redirected to view where you can manage shows for this cinema.
#####Manage shows panel
In the first card you can select a day to see shows, from day you will select, you need too click Submit to reload page.
Next you have form to add new shows.
And at the bottom is displayed list of rooms and shows that take place in them. If room hasn't got any show planed for selected day it won't be shown on the list.

