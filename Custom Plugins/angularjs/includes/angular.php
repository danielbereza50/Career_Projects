<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>AngularJS</title>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-route.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.js"></script> 
</head>
<body>
  <div class="container">
  <div class="row">
    <div ng-app = "mainApp" ng-controller = "studentController">
         <table border = "0">
            <tr>
               <td>Enter first name:</td>
               <td><input type = "text" ng-model = "student.firstName"></td>
            </tr>
            <tr>
               <td>Enter last name: </td>
               <td><input type = "text" ng-model = "student.lastName"></td>
            </tr>
            <tr>
               <td>Enter fees: </td>
               <td><input type = "text" ng-model = "student.fees"></td>
            </tr>
            <tr>
               <td>Enter subject: </td>
               <td><input type = "text" ng-model = "subjectName"></td>
            </tr>
         </table>
         <br/>
         <table border = "0">
            <tr>
               <td>Name in Upper Case: </td><td>{{student.fullName() | uppercase}}</td>
            </tr>
            <tr>
               <td>Name in Lower Case: </td><td>{{student.fullName() | lowercase}}</td>
            </tr>
            <tr>
               <td>fees: </td><td>{{student.fees | currency}}
               </td>
            </tr>
            <tr>
               <td>Subject:</td>
               <td>
                  <ul>
                     <li ng-repeat = "subject in student.subjects | filter: subjectName |orderBy:'marks'">
                        {{ subject.name + ', marks:' + subject.marks }}
                     </li>
                  </ul>
               </td>
            </tr>
         </table>
      </div>
    </div>
</div>
<script>
         var mainApp = angular.module("mainApp", []);
         mainApp.controller('studentController', function($scope) {
            
             $scope.student = {
               firstName: "Mahesh",
               lastName: "Parashar",
               fees:500,
               
               subjects:[
                  {name:'Physics',marks:70},
                  {name:'Chemistry',marks:80},
                  {name:'Math',marks:65}
               ],
                
               fullName: function() {
                  var studentObject;
                  studentObject = $scope.student;
                  return studentObject.firstName + " " + studentObject.lastName;
               }
                 
            };
});
</script>

<input type="hidden" id="ajaxurl" value="<?php echo  admin_url( 'admin-ajax.php' ); ?>">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>

