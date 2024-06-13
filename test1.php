<!DOCTYPE html>
<html lang="en" ng-app="cakeApp">
<head>
    <meta charset="UTF-8">
    <title>AWP Mini Project</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .cake-info {
            padding-top: 30px;
        }
        .cake-name {
            font-size: 24px;
            color: #333;
        }
        .cake-description {
            color: grey;
        }
        .stars i {
            color: #ffd700;
            cursor: pointer;
        }
        .stars i:hover,
        .stars i.active {
            color: #f39c12;
        }
    </style>
</head>
<body>
    <div class="container" ng-controller="CakeController">
        <div class="cake-info">
            <img src="user.png" alt="Cake Image">
            <h1 class="cake-name">Purple Bow Cake</h1>
            <p class="cake-description">A cake with moist and airy texture</p>
            <div class="stars">
                <i ng-click="rateCake(1)" ng-class="{ 'active': rating >= 1 }" class="fa fa-star"></i>
                <i ng-click="rateCake(2)" ng-class="{ 'active': rating >= 2 }" class="fa fa-star"></i>
                <i ng-click="rateCake(3)" ng-class="{ 'active': rating >= 3 }" class="fa fa-star"></i>
                <i ng-click="rateCake(4)" ng-class="{ 'active': rating >= 4 }" class="fa fa-star"></i>
                <i ng-click="rateCake(5)" ng-class="{ 'active': rating >= 5 }" class="fa fa-star"></i>
            </div>
            <p>Average Rating: {{ averageRating }}</p>
        </div>
        <div class="weight-selector" ng-app="myApp" ng-controller="myctrl">
            <p style="color:grey">Choose Weight:</p>
            <select ng-model="selectedCake" ng-options="x for(x,y) in cake"></select>
        </div>
    </div>

    <script>
        angular.module('cakeApp', [])
            .controller('CakeController', ['$scope', function($scope) {
                $scope.rating = 0;
                $scope.rateCake = function(rating) {
                    $scope.rating = rating;
                };

                // Sample ratings
                var ratings = [4, 3, 5, 2, 4];
                $scope.averageRating = calculateAverageRating(ratings);

                function calculateAverageRating(ratings) {
                    var total = 0;
                    for (var i = 0; i < ratings.length; i++) {
                        total += ratings[i];
                    }
                    return (total / ratings.length).toFixed(1);
                }
            }]);
    </script>
</body>
</html>
