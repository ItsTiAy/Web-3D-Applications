var modelData;
var brandData;
var activeModel = "canModel";
var fadeTime = 500;

$(document).ready(function()
{
    $.getJSON("index.php/apiGetModelData", function(jsonObj) 
    {
        modelData = jsonObj;

        $('#x3dTitle').html('<h2>' + modelData[0].x3dModelTitle + '</h2>');
        $('#x3dCreationMethod').html('<p>' + modelData[0].x3dCreationMethod + '</p>');
    })

    $.getJSON("index.php/apiGetBrandData", function(jsonObj) 
    {
        brandData = jsonObj;

        $('#brandName').html('<h2>' + brandData.brandName + '</h2>');
        $('#brandDescription').html('<p>' + brandData.brandDescription + '</p>');
    })

    loadModels();
});

function switchModel(modelIndex)
{
    $('x3d').fadeOut(fadeTime, 
    function()
    {
        document.getElementById(activeModel).setAttribute('visible', false);

        switch(modelIndex)
        {
            case 0: 
                modelName = "canModel";
                break;
            case 1:
                modelName = "tallCanModel";
                break;
            case 2:
                modelName = "bottleModel";
                break;
            default:
                modelName = "canModel";
                break;
        }

        activeModel = modelName;

        $('#x3dTitle').html('<h2>' + modelData[modelIndex].x3dModelTitle + '</h2>');
        $('#x3dCreationMethod').html('<p>' + modelData[modelIndex].x3dCreationMethod + '</p>');

        document.getElementById(activeModel).setAttribute('visible', true);

        $('x3d').fadeIn(fadeTime);
        $('#x3dTitle').fadeIn(fadeTime);
        $('#x3dCreationMethod').fadeIn(fadeTime);
    });

    $('#x3dTitle').fadeOut(fadeTime);
    $('#x3dCreationMethod').fadeOut(fadeTime);
}

function loadModels()
{
    var canX3D = "<inline id = 'canModel' nameSpaceName = 'model' mapDEFToID = 'true' url='../assets/x3d/" + "AppletiserCan" + ".x3d'> </inline>"
    var tallCanX3D = "<inline id = 'tallCanModel' nameSpaceName = 'model' mapDEFToID = 'true' url='../assets/x3d/" + "AppletiserTallCan" + ".x3d' visible=false> </inline>"
    var bottleX3D = "<inline id = 'bottleModel' nameSpaceName = 'model' mapDEFToID = 'true' url='../assets/x3d/" + "AppletiserBottle" + ".x3d' visible=false> </inline>"


    $('#model').html(canX3D + tallCanX3D + bottleX3D);
}