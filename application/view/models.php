<?php include_once("header.php") ?>

<!-- link Menu Icon button to the links class navbar-collapse selector] -->
                <div class="collapse navbar-collapse">
<!-- Links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a id="navAbout" class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal" data-trigger="hover" data-placement="bottom" title="About Web 3D Applications" data-content="3D Apps is a final year and postgraduate module ...">About</a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a id="navModels" class="nav-link active"  href="models" data-toggle="popover" data-trigger="hover" data-placement="bottom" title="X3D Models" data-content="There are three X3D models: Coke, Sprite and Pepper">Models</a>
                    </li>-->
                </ul>
            </div>
        </nav>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">About</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        This is an X3D based Coca Cola Branded 3D App.
                    </div>
                </div>
            </div>
        </div>


    <!-- X3dom -->
    <link rel='stylesheet' type='text/css' href='../application/css/x3dom.css'>
    <!-- Include the x3dom JavaScript -->
    <script type='text/javascript' src='../application/js/x3dom.js'></script>
    <title>Models</title>
    <div id = "main">
        <!-- Column to hold the X3D Model -->
        <div class="container-fluid">
            <div class="row">

                <div id = "modelsCard" class="col-sm-6">
                    <div id = "modelContent">
                        <div class="card shadow text-left mb-3">
                            <div class="card-header">
                                <div id ="x3dTitle"></div>
                                <div id ="x3dCreationMethod"></div>
                                <ul class="nav nav-pills card-header-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle = "tab" href="#coke" onclick="switchModel(0);">Can</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle = "tab" href="#sprite" onclick="switchModel(1);">Tall Can</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle = "tab" href="#drPepper" onclick="switchModel(2);">Bottle</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">

                                <!-- Bootstrap 4 card body to hold information about the X3D model-->
                                <div id = "coke" class="container tab-pane active">
                                    <div class="model3D">
                                        <div class ="model3DContent">
                                            <x3d id = "x3dElement">
                                                <scene id = "model">

                                                </scene>
                                            </x3d>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>

                        <div id ="buttonCard" class="card shadow text-left mb-3">
                            <div id = "cameraButtons" class="btn-group-justified text-center">
                                <a class="btn btn-outline-primary btn-responsive" onclick="cameraFront();">Front</a>
                                <a class="btn btn-outline-primary btn-responsive" onclick="cameraBack();">Back</a>
                                <a class="btn btn-outline-primary btn-responsive" onclick="cameraTop();">Top</a>
                                <a class="btn btn-outline-primary btn-responsive" onclick="cameraBottom();">Bottom</a>

                                <a class="btn btn-outline-secondary btn-responsive" data-toggle="button" aria-pressed="true" autocomplete="off" onclick="headLight();">HeadLight</a>
                                <a class="btn btn-outline-secondary btn-responsive" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="pointLights();">Coloured Lights</a>

                                <a class="btn btn-outline-success btn-responsive" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="wireframe();"> Wireframe </a>
                                <a class="btn btn-outline-success btn-responsive" id = "animationButton" onclick="animation();">Play Animation</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div id = "infoCard" class="col-sm-6">
                    <div class="card shadow text-left mb-3">
                        <div class="card-header" id = "brandName">

                        </div>

                        <div class="card-body" id = "brandDescription">
                            
                        </div>
                    </div>

                    <div class="card shadow text-left mb-3">
                        <div class="card-header">
                            <h2>Gallery</h2>
                        </div>

                        <div class="card-body">
                            <div class="card-title title_gallery drinksText"></div>
                            <div class="gallery" id="gallery"></div>
                            <div class="card-text description_gallery drinksText"></div>
                        </div>
                    </div>

                </div>
            </div> 
        </div> 
    </div>
<?php include_once("footer.php") ?>