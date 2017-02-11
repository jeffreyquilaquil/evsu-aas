The initial technical interview test will involve developing a basic application using the Ionic 2 mobile framework which is built on Cordova and AngularJS 2
 
The code must be written in TypeScript (be sure to use the --ts option with the ionic start command which sets up a basic project with TypeScript files)
 
The code must be committed to a Git repository (GitHub, BitBucket etc)
 
See http://ionicframework.com/docs/v2/getting-started/installation/ for instructions to setup a basic Ionic 2 project
 
The main setup commands will be to install node.js then run:
 
sudo npm install -g cordova
npm install -g ionic@beta
ionic start demoproject --v2 --ts
 
The test tasks are:
 
* Create a basic email/password login screen which is the default screen when the app loads.
* Create an Authentication service which allows any valid email and password of at least 4 characters to login, and provides validation messages on the screen otherwise
 
* Create a Projects screen which lists the available projects (using the Ionic list components) and has a toolbar button to create a new project.
* Create a Projects service class which uses localStorage to store and retrieve the projects
* A Project has a name, and the name must be unique. Creating another project with the same name will have a validation error.
 
* Develop unit tests for the Projects screen