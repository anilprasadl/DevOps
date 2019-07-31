@extends('layouts.app') @section('content')
<div class="container" ng-cloak ng-app="appDetailsApp" ng-controller="appDetailsController as ctrl">
    <div class="row">
        <div class="col-md-12  col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Configuration Management</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 p-3">
                            <md-button md-theme="@{{theme}}" class="md-fab md-mini md-primary md-raised pull-right" ng-click="addNewSlot()" title="Add" alt="Add" >
                                <span class="fa fa-plus"></span>
                            </md-button>
                            <md-button md-theme="@{{theme}}" class="md-primary md-raised" ng-click="showAdvanced($event)">Open Dialog</md-button>
                        </div>
                    </div>
                    <br>
                    <div class="alert alert-success" ng-if="successMessage" id="success-alert">
                        <a href="#" class="close" data-dismiss="alert">&#10799;</a>
                        <span ng-model="successMessage">@{{successMessage}}</span>
                    </div>
                    <br/>
                    <div raw-ajax-busy-indicator class="bg_load text-center" ng-show="loading" id="loading-block">
                        <img src="{{asset('img/Infinity-1s-200px.svg')}}" style="margin-left: 0px;margin-top: 300px;">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">

                                <table class="table" id="app_listing">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add / edit modal eventtype begins -->
    <!-- <div style="visibility: hidden" class="container">
    <div class="md-dialog-container" id="myStaticDialog">
    
      <md-dialog md-theme="@{{theme}}">
       <form ng-cloak> -->
      <!-- <md-toolbar>
        <div class="md-toolbar-tools" >
            <h2>Mango (Fruit)</h2>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon aria-label="Close dialog">X</md-icon>
            </md-button>
        </div>
      </md-toolbar>
      <md-dialog-content>
      <div class="container-fluid">
      <div class="form-group">
                                        <label for="Name">Name</label>
                                        <input id="title" type="text" class="form-control" ng-model="app.name " required>
                                    </div>
                                    <div class="form-group" ng-init="fetchUsers()">
                                        <label for="ownerlist">Lead By</label>
                                        <select class="form-control" ng-model="app.lead_by_id" ng-options="cat.id as cat.name for cat in users" ng-required="required">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Technology">Technology Stack</label>
                                        <input id="title" type="text" class="form-control" ng-model="app.tech_stack " required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Start">Start Date</label>
                                        <div class="input-group" moment-picker="app.start_date" format="YYYY-MM-DD" min-date="ctrl.minDateMoment">
                                            <input class="form-control" placeholder="Select a date" ng-model="app.start_date" ng-model-options="{ updateOn: 'blur' }" required>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="End">End Date</label>
                                        <div class="input-group" moment-picker="app.end_date" format="YYYY-MM-DD" min-date="ctrl.minDateMoment">
                                            <input class="form-control" placeholder="Select a date" ng-model="app.end_date" ng-model-options="{ updateOn: 'blur' }" required>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name" class="checkbox-inline">
                                        <md-checkbox      ng-model="app.is_POC" name="string" ng-true-value="1" >
                                        Is POC project</label>
                                        </md-checkbox>
                                    </div>
                                    <h2>Environment Details</h2>
                                    <br>
                                    <md-button md-theme="@{{theme}}" class="md-fab md-mini md-raised" ng-click="addInputs()" style="backgroundcolor: greenyellow;" ><i class="fa fa-plus" aria-hidden="true" aria-label="button"></i></md-button>

                                    <div class="form-group" id="dynamic_field">  
                                        
                                    </div>   -->
                                    
                                        <!-- List Multiple Inputs -->
                                        <!-- <section ng-repeat="env in envs">
                                            <span class="serial-number">@{{ $index + 1 }}.</span>
                                            <div class="form-group">
                                        <label for="Type">Type</label>
                                        <input id="title" type="dropdown" class="form-control" ng-model="app.env.type" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name">App URL</label>
                                        <input id="title" type="url" class="form-control" ng-model="app.env.url" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="IP">IP</label>
                                        <input id="title" type="text" class="form-control" ng-model="app.env.ip"  ng-pattern="/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/"
                                            ng-model-options="{ updateOn: 'blur' }" placeholder='xxx.xxx.xxx.xxx'  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Port">Port</label>
                                        <input id="title" type="text" pattern="\d*" maxlength="4" class="form-control" ng-model="app.env.port" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Provider">Provider</label>
                                        <input id="title" type="text" class="form-control" ng-model="app.env.provider" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Instance">Instance Family</label>
                                        <input id="title" type="text" class="form-control" ng-model="app.env.instance_family" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Deployment">Deployment Hook</label>
                                        <input id="title" type="text" class="form-control" ng-model="app.env.deploy_hook" required>
                                    </div>
                                    <button type="button" ng-click="addInputs()" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true"></i></button>

                                            <button type="button" ng-click="removeInputs(env)" name="remove"  class="btn btn-danger btn_remove">X</button>
                                        </section>
        </div>
        </md-dialog-content>
      </md-dialog>

    </div>
  </div> --> -->

    <div id="addSlot" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Application Details</h4>
                </div>
                <form class="cmxform" ng-submit="saveSlot()" ng-model="app">
                    <div class="modal-body">
                        <br>
                        <!-- Error begins -->
                        <div class="alert alert-danger" id="error-alert" ng-if="error_msg">
                            <a href="#" class="close" data-dismiss="alert">&times;</a> @{{ error_msg }}
                        </div>
                        <br>
                        <!-- Error ends  -->

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-9     col-md-offset-1">
                                    <div class="form-group">
                                        <label for="Name">Name</label>
                                        <input id="title" type="text" class="form-control" ng-model="app.name " required>
                                    </div>
                                    <div class="form-group" ng-init="fetchUsers()">
                                        <label for="ownerlist">Lead By</label>
                                        <select class="form-control" ng-model="app.lead_by_id" ng-options="user.id as user.name for user in users" ng-required="required">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Technology">Technology Stack</label>
                                        <input id="title" type="text" class="form-control" ng-model="app.tech_stack " required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Start">Start Date</label>
                                        <div class="input-group" moment-picker="app.start_date" format="YYYY-MM-DD" min-date="ctrl.minDateMoment">
                                            <input class="form-control" placeholder="Select a date" ng-model="app.start_date" ng-model-options="{ updateOn: 'blur' }" required>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="End">End Date</label>
                                        <div class="input-group" moment-picker="app.end_date" format="YYYY-MM-DD" min-date="ctrl.minDateMoment">
                                            <input class="form-control" placeholder="Select a date" ng-model="app.end_date" ng-model-options="{ updateOn: 'blur' }" required>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name" class="checkbox-inline">
                                        <md-checkbox ng-model="app.is_POC" md-theme="@{{theme}}" name="string" ng-true-value="1" style="backgroundcolor:blue" >
                                        Is POC project</label>
                                        </md-checkbox>
                                    </div>
                                    <h2>Environment Details</h2>
                                    <br>
                                    <md-button md-theme="@{{theme}}" class="md-fab md-mini md-primary md-raised" ng-click="addInputs()"  ><i class="fa fa-plus" aria-hidden="true" aria-label="button"></i></md-button>

                                    <div class="form-group" id="dynamic_field">  
                                        
                                    </div>  
                                    
                                        <!-- List Multiple Inputs -->
                                        <section ng-repeat="(key,value) in envs track by $index">
                                            <span class="serial-number">@{{ $index + 1 }}.</span>
                                            <div class="form-group">
                                        <label for="Type">Type</label>
                                        <input id="title" type="dropdown" class="form-control" ng-model="app_env[key].type" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name">App URL</label>
                                        <input id="title" type="url" class="form-control" ng-model="app_env[key].url" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="IP">IP</label>
                                        <input id="title" type="text" class="form-control" ng-model="app_env[key].ip"  ng-pattern="/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/"
                                            ng-model-options="{ updateOn: 'blur' }" placeholder='xxx.xxx.xxx.xxx'  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Port">Port</label>
                                        <input id="title" type="text" pattern="\d*" maxlength="4" class="form-control" ng-model="app_env[key].port" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Provider">Provider</label>
                                        <input id="title" type="text" class="form-control" ng-model="app_env[key].provider" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Instance">Instance Family</label>
                                        <input id="title" type="text" class="form-control" ng-model="app_env[key].instance_family" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Deployment">Deployment Hook</label>
                                        <input id="title" type="text" class="form-control" ng-model="app_env[key].deploy_hook" required>
                                    </div>
                                    <div class="form-group">
                                    <span>
                                        <md-button md-theme="@{{theme_red}}" class="md-fab md-raised md-mini md-primary test-tooltip" title="Add" ng-click="addInputs()" ><i class="fa fa-plus" aria-hidden="true"></i>
                                        <md-tooltip md-direction="left">Add</md-tooltip></md-button>
                                        <md-button class="md-fab md-raised md-mini" ng-click="removeInputs(env)" name="remove"  ><i class="fa fa-times" aria-hidden="true"></i></md-button>
                                        </span>
                                        <div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add /edit eventtype modal ends  -->

    <!-- delete modal begins -->
    <div id="cancelTask" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&#10799;</button>
                    <h4 class="modal-title">Cancel Task</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-9    col-md-offset-1">
                                <form class="cmxform" ng-submit="cancelConfirmed()" ng-model="myevents">
                                    <div class="form-group">
                                        <p>Are you sure to Cancel the event?</p>
                                        <br>
                                        <div class="form-group">
                                            <label for="myevents">State * </label>
                                            <select class="form-control"  ng-init="fetchState()" ng-model="myevents.state" data-size="10" ng-required="required" ng-options=" st.name for st in state">
                                            <option value="" selected disabled hidden>Select State</option>
                                            </select>
                                        </div>

                                        <label>Comments *</label>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3" cols="54" placeholder="Please give us a comment for cancellation!" ng-required="required" ng-model="myevents.comments" required></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            No</button>
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- delete ends -->

</div>
@endsection @section('pageScript')

<script type="text/javascript">
    var app = angular.module('appDetailsApp', ['moment-picker','ngMaterial','ngAnimate']);
    app.config(function ($mdThemingProvider) {
    $mdThemingProvider.theme('red')
      .primaryPalette('red');

    $mdThemingProvider.theme('blue')
      .primaryPalette('blue');

  });
    app.controller('appDetailsController', function($scope, $http, $mdDialog, $compile, $interval) {

        $scope.init = function() {
            $scope.listApps();
            $scope.app = {};
            // $scope.app.env = {};
        }
        var ctrl = this;

        // angular material design scripts
        $scope.theme = 'blue';
        $scope.theme_red = 'red';
        // var isThemeRed = true;

        //     $interval(function () {
        //         $scope.theme = isThemeRed ? 'blue' : 'red';

        //         isThemeRed = !isThemeRed;
        // }, 5000);
        // ctrl.minDateMoment = moment().add(0, 'day');
        // ctrl.maxDateMoment = moment().subtract(1, 'day');
        // $scope.showAdvanced = function(ev) {
        //     $mdDialog.show({
        //         controller: DialogController,
        //         contentElement: '#myStaticDialog',
        //         parent: angular.element(document.body),
        //         targetEvent: ev,
        //         clickOutsideToClose:true
        //         // template:
        //         //                     '<md-dialog>'+
        //         //                         '<md-dialog-content>'+
        //         //                         // '<div class="form-group">'+
        //         //                             '<label for="Type">Type</label>'+
        //         //                             '<input id="title" type="dropdown" class="form-control" ng-model="app.env.type" required>'+
        //         //                         // '</div>'+
        //         //                         // '<div class="form-group">'+
        //         //                             '<label for="Name">App URL</label>'+
        //         //                             '<input id="title" type="url" class="form-control" ng-model="app.env.url" required>'+
        //         //                         // '</div>'+
        //         //                         // '<div class="form-group">'+
        //         //                             '<label for="IP">IP</label>'+
        //         //                             '<input id="title" type="text" class="form-control" ng-model="app.env.ip"  ng-pattern="/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/"'+
        //         //                                 'ng-model-options="{ updateOn: '+"blur"+' }" placeholder='+"xxx.xxx.xxx.xxx"+'  required>'+
        //         //                         // '</div>'+
        //         //                         // '<div class="form-group">'+
        //         //                             '<label for="Port">Port</label>'+
        //         //                             '<input id="title" type="text" ng-pattern="\\d*" maxlength="4" class="form-control" ng-model="app.env.port" required>'+
        //         //                         // '</div>'+
        //         //                         // '<div class="form-group">'+
        //         //                             '<label for="Provider">Provider</label>'+
        //         //                             '<input id="title" type="text" class="form-control" ng-model="app.env.provider" required>'+
        //         //                         // '</div>'+
        //         //                         // '<div class="form-group">'+
        //         //                             '<label for="Instance">Instance Family</label>'+
        //         //                             '<input id="title" type="text" class="form-control" ng-model="app.env.instance" required>'+
        //         //                         // '</div>'+
        //         //                         // '<div class="form-group">'+
        //         //                             '<label for="Deployment">Deployment Hook</label>'+
        //         //                             '<input id="title" type="text" class="form-control" ng-model="app.env.hook" required>'+
        //         //                         // '</div>'+
                                        
                                        
        //         //                     '</md-dialog-content>'+
        //         //                     '  <md-dialog-actions>' +
        //         //                     '    <ng-click="closeDialog()" class="md-primary">' +
        //         //                     '      <md-button  class="btn btn-danger ">X</md-button >'+
        //         //                         '<md-button  class="btn btn-success "><i class="fa fa-plus" aria-hidden="true"></i>'+
        //         //                     '    </md-button>' +
        //         //                     '  </md-dialog-actions>' +
        //         //                     '</md-dialog>',
        //         })
        //     .then(function(answer) {
        //         $scope.status = 'You said the information was "' + answer + '".';
        //         }, function() {
        //         $scope.status = 'You cancelled the dialog.';
        //     });
        // };
        // function DialogController($scope, $mdDialog) {
        //     $scope.hide = function() {
        //     $mdDialog.hide();
        // };
        // $scope.cancel = function() {
        //     $mdDialog.close();
        //     };

        //     $scope.answer = function(answer) {
        //     $mdDialog.hide(answer);
        //     };
        // }
        $scope.envs = [
                        {}
                    ];
        
        $scope.addInputs = function() {
            var newInput = {};
            $scope.envs.push(newInput);
        }
        
        $scope.removeInputs = function(env) {
            var index = $scope.envs.indexOf(env);
            $scope.envs.splice(index,1);
            $scope.app_env.indexOf(env)= {};
        }
        //Script to list eventtypes
        $scope.listApps = function() {
            $('#app_listing').DataTable({
                processing: true,
                stateSave: true,
                serverSide: true,
                destroy: true,
                "oLanguage": {
                    "sEmptyTable": "No Tasks Created till Now"
                },
                ajax: 'apps/list',
                columns: [{
                    data: 'name'
                }, {
                    data: 'start_date',
                    searchable: false,
                }, {
                    data: 'end_date',
                    searchable: false,
                }, {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }, ],
                createdRow: function(row, data, dataIndex) {
                    $compile(angular.element(row).contents())($scope);
                },
                "fnDrawCallback": function() {
                    if ($(this).DataTable().row().data() === undefined && $(this).DataTable().page.info().page != 0) {
                        $(this).DataTable().state.clear();
                        
                    }
                }
            });
        }
        $scope.fetchUsers=function(){
            $scope.errors = $scope.successMessage = null;
            var url = 'users/list';
            $http.get(url).then(function(response) {
                if (response.status == 200) {
                    $scope.users= response.data.data;
                    
                } else {
                    $scope.errors = response.data.error;
                }
            });
        }
        $scope.fetchState = function() {

            $scope.state = [{
                id: 1,
                name: '{{App\Event::USER_STATE_RU}}'
            }, {
                id: 2,
                name: '{{App\Event::USER_STATE_RS}}'
            }, {
                id: 3,
                name: '{{App\Event::USER_STATE_CW}}'
            }, {
                id: 4,
                name: '{{App\Event::USER_STATE_OTHER}}'
            }];

        }

        // $scope.camelCase = function(str) {
        //         // alert(str); //test
        //         return str.replace(/\w\S*/g, function (txt) {
        //             return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        //         });
        //     }

        $scope.addNewSlot = function() {
            $scope.error_msg = $scope.successMessage = null;
            $scope.app = {};
            $scope.env=[];
            $scope.app_env = {};
            $scope.app.status = '{{App\Event::STATUS_CREATED}}'
            $("#addSlot").modal("show");
        };
        //Edit eventtype
        $scope.edit = function(id) {
            $scope.errors = $scope.successMessage = null;
            var url = 'config/' + id;
            $http.get(url).then(function(response) {
                console.log(response.data.data);
                if (response.status == 200) {
                    $("#addSlot").modal('show');
                    $scope.app = response.data.data;
                    $scope.app_env = response.data.data.app_env;
                    $scope.envs = [];
                    for(var i=0; i< response.data.data.app_env.length; i++){
                        $scope.envs.push({});
                    }
                    
                } else {
                    $scope.errors = response.data.error;
                }
            });
        }
        $scope.delete = function (id) {
            $scope.error_msg = $scope.successMessage = null;
            $scope.selected_config_id = id;
            $scope.show_delete = true;
            $scope.delete_msg = 'You are going to remove this record.  Are you Sure?';
            $("#deleteConfirm").modal('show');
        }

        $scope.deleteConfirmed = function () {          
            var url = '/config/' + $scope.selected_config_id;
            $http.delete(url).then(function (response) {            
                if (response.status == 200) {
                    $scope.error_msg = $scope.successMessage = null;
                    $scope.listApps();
                    $("#deleteConfirm").modal('hide');
                    $scope.successMessage = response.data.message;

                } else {
                    $scope.show_delete = false;
                    $scope.error_msg = response.data.error.message;

                }
            });
        }

        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
        //Delete eventtype
        $scope.cancelEvent = function(id, status) {
            $scope.myevents = {};
            $scope.errors = $scope.successMessage = null;
            $scope.myevents.id = id;
            $scope.myevents.status = status;
            $scope.show_delete = true;
            $("#cancelTask").modal('show');
        }

        $scope.cancelConfirmed = function() {
            $scope.loading = true;
            $http.post('/myevents-cancel', $scope.myevents).then(function(response) {

                $scope.error_msg = $scope.successMessage = null;
                if (response.status == 200) {
                    $scope.successMessage = response.data.message;
                    
                    $scope.listDeletedEvents();
                    $("#cancelTask").modal('hide');
                } else {
                    $scope.show_delete = false;
                    $scope.error_msg = response.data.error;
                }
            }).finally(function() {
                $scope.loading = false;
            });
        }

        $scope.saveSlot = function() {
            $scope.loading = true;
            console.log($scope.app);
            $http.post('config', $scope.app).then(function(response) {
                if (response.status == 200) {
                    // $("#addSlot").modal('hide');
                    $scope.successMessage = response.data.message;
                    $scope.listApps();
                    // window.location.reload();
                } else {
                    $scope.error_msg = response.data.error;
                }
            });
            // .finally(function() {
            //     $scope.loading = false;
            // });
        }
        // $scope.choices = [{id: 'choice1', name: 'choice1'}, {id: 'choice2', name: 'choice2'}, {id: 'choice3', name: 'choice3'}];
            
            $scope.addNewChoice = function() {
                $scope.app.env.push({'id' : 'choice' + newItemNo, 'name' : 'choice' + newItemNo});
            };
            
            // $scope.removeNewChoice = function() {
            //     var newItemNo = $scope.choices.length-1;
            //     if ( newItemNo !== 0 ) {
            //     $scope.choices.pop();
            //     }
            // };
            
            // $scope.showAddChoice = function(choice) {
            //     return choice.id === $scope.choices[$scope.choices.length-1].id;
            // };

        $scope.init();
    });
    app.filter('capitalize', function() {
            return function(input) {
            return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
            }
        });



    $(document).ready(function(){      
      var postURL = "<?php echo url('+'); ?>";
      var i=0;  

      $(document).on('click','.btn_add', function(){  
           i++;  
        //    $('#dynamic_field').append('<div id="row'+i+'" class="dynamic-added"><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button><br>'+
        //    '<button type="button" name="add" id="add" class="btn btn-success btn_add"><i class="fa fa-plus" aria-hidden="true"></i>'
        //    ); 
        $('#dynamic_field').append('<div  id="row'+i+'">'+
                                        '<div class="form-group">'+
                                            '<label for="Type">Type</label>'+
                                            '<input id="title" type="dropdown" class="form-control" ng-model="app.env.type" required>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="Name">App URL</label>'+
                                            '<input id="title" type="url" class="form-control" ng-model="app.env.url" required>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="IP">IP</label>'+
                                            '<input id="title" type="text" class="form-control" ng-model="app.env.ip"  ng-pattern="/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/"'+
                                                'ng-model-options="{ updateOn: '+"blur"+' }" placeholder='+"xxx.xxx.xxx.xxx"+'  required>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="Port">Port</label>'+
                                            '<input id="title" type="text" ng-pattern="\\d*" maxlength="4" class="form-control" ng-model="app.env.port" required>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="Provider">Provider</label>'+
                                            '<input id="title" type="text" class="form-control" ng-model="app.env.provider" required>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="Instance">Instance Family</label>'+
                                            '<input id="title" type="text" class="form-control" ng-model="app.env.instance" required>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="Deployment">Deployment Hook</label>'+
                                            '<input id="title" type="text" class="form-control" ng-model="app.env.hook" required>'+
                                        '</div>'+
                                        '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>'+
                                        '<button type="button" name="add" id="add" class="btn btn-success btn_add"><i class="fa fa-plus" aria-hidden="true"></i>'+
                                    '</div>');
            
      });  

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


    });  
</script>
@endsection