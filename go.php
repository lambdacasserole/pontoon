<?php

require 'core.php';

// No unauthenticated deploys!
protectPage();

// Run relevant deploy.
$hash = $_GET['project'];
$targets = getDeployTargets();
foreach ($targets as $target)
{
    if ($target->getIdentifier() == $hash)
    {
        $result = exec($target->getDeployCommand()); // Execute script.
        if ($result == null)
        {
            echo json_encode([
                'status' => 'warning',
                'message' => 'It doesn\'t look like your website deployed properly. Executing your script returned null.',
            ]); // Null output from script.
        }
        else if ($result == '0')
        {
            echo json_encode([
                'status' => 'success',
                'message' => 'Your website should be online and ready! Your script ran without a problem.',
            ]); // If script returns 0, that means success.
        }
        else if ($result == '1') {
            echo json_encode([
                'status' => 'danger',
                'message' => 'There was a problem deploying your site. Your script returned a failure.',
            ]); // If script returns 1, that means failure.
        }
        else
        {
            echo json_encode([
                'status' => 'info',
                'message' => 'Your script returned something weird. You should look into this further.',
            ]); // If script returns something else, we dunno.
        }
    }
}
