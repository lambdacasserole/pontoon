<?php

require 'core.php';

// Set security headers.
setSecurityHeaders();

// No unauthenticated deploys!
if ($_GET['key'] != getGlobalConfiguration()->getApiKey())
{
    protectPage();
}

// Run relevant deploy.
$hash = $_GET['project'];
$targets = getDeployTargets();
foreach ($targets as $target)
{
    if ($target->getIdentifier() == $hash)
    {
        $result = 'Trying to execute deploy as: ' . shell_exec('whoami');
        $result .= 'Executing: ' . $target->getDeployCommand() . "\r\n";
        $result .= shell_exec($target->getDeployCommand() . ' 2>&1'); // Execute script.
        $status = $result[strlen(trim($result)) - 1];
        if ($result == null)
        {
            echo json_encode([
                'status' => 'warning',
                'message' => 'It doesn\'t look like your website deployed properly. Executing your script returned null.',
                'result' => $result,
            ]); // Null output from script.
        }
        else if ($status == '0')
        {
            echo json_encode([
                'status' => 'success',
                'message' => 'Your website should be online and ready! Your script ran without a problem.',
                'result' => $result,
            ]); // If script returns 0, that means success.
        }
        else if ($status == '1')
        {
            echo json_encode([
                'status' => 'danger',
                'message' => 'There was a problem deploying your site. Your script returned a failure.',
                'result' => $result,
            ]); // If script returns 1, that means failure.
        }
        else
        {
            echo json_encode([
                'status' => 'info',
                'message' => 'Your script returned something weird. You should look into this further.',
                'result' => $result,
            ]); // If script returns something else, we dunno.
        }
    }
}
