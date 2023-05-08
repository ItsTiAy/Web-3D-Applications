var isWireframe = false;
var x3d = document.getElementById('x3dElement');
var headLightOn = true;
var pointLightsOn = false;
var animationPlaying = false;
var animationPaused = false;

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

function wireframe()
{
	if(isWireframe)
	{
		x3d.runtime.togglePoints(true);

		isWireframe = false;
	}
	else
	{
		x3d.runtime.togglePoints(true);
		x3d.runtime.togglePoints(true);

		isWireframe = true;
	}
}

function cameraFront()
{
	document.getElementById('model__CA_CameraFront').setAttribute('bind', 'true');
	x3d.runtime.resetView();
}

function cameraBack()
{
	document.getElementById('model__CA_CameraBack').setAttribute('bind', 'true');
	x3d.runtime.resetView();
}

function cameraTop()
{
	document.getElementById('model__CA_CameraTop').setAttribute('bind', 'true');
	x3d.runtime.resetView();
}

function cameraBottom()
{
	document.getElementById('model__CA_CameraBottom').setAttribute('bind', 'true');
	x3d.runtime.resetView();
}

function headLight()
{
	headLightOn = !headLightOn;
	document.getElementById('model__headlight').setAttribute('headlight', headLightOn.toString());
}

function pointLights()
{
	pointLightsOn = !pointLightsOn;
	document.getElementById('model__LA_FrontLight').setAttribute('on', pointLightsOn.toString());
	document.getElementById('model__LA_BackLight').setAttribute('on', pointLightsOn.toString());
	document.getElementById('model__LA_LeftLight').setAttribute('on', pointLightsOn.toString());
	document.getElementById('model__LA_RightLight').setAttribute('on', pointLightsOn.toString());
}

function animation()
{
	date = new Date()

	if (document.getElementById('model__' + activeModel).getAttribute('isActive'))
	{
		if(document.getElementById('model__' + activeModel).getAttribute('isPaused'))
		{
			document.getElementById('model__' + activeModel).setAttribute('resumeTime', date.getTime() / 1000);

			document.getElementById('animationButton').textContent = "Pause Animation";
		}
		else
		{
			document.getElementById('model__' + activeModel).setAttribute('pauseTime', date.getTime() / 1000);

			document.getElementById('animationButton').textContent = "Resume Animation";
		}
	}
	else
	{
		document.getElementById('model__' + activeModel).setAttribute('startTime', date.getTime() / 1000);

		document.getElementById('animationButton').textContent = "Pause Animation";
	}
}

function isFinished(eventObject)
{
	if(eventObject.type != "outputchange" || eventObject.fieldName != "isActive")
	{
		return;
	}

	var isActive = eventObject.value;

	if(!isActive)
	{
		document.getElementById('animationButton').textContent = "Start Animation";
	}
}

// Important number 193.081 cm