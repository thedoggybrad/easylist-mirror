<?php

$repositoryOwner = 'thedoggybrad'; // Replace with your repository owner
$repositoryName = 'easylist-mirror'; // Replace with your repository name
$workflowName = 'updater.yml'; // Replace with your workflow name
$token = 'TOKEN'; // Replace with your personal access token

$apiUrl = "https://api.github.com/repos/{$repositoryOwner}/{$repositoryName}/actions/workflows";
$workflowUrl = "{$apiUrl}/{$workflowName}/dispatches";

$commitUrl = "https://api.github.com/repos/{$repositoryOwner}/{$repositoryName}/commits?per_page=1";
$ch = curl_init($commitUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json',
    'Accept: application/vnd.github.v3+json',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36' // Replace with your User-Agent header value
]);

$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    $commits = json_decode($result, true);
    if (!empty($commits)) {
        $lastCommitTimestamp = strtotime($commits[0]['commit']['committer']['date']);
        $currentTimestamp = time();
        $timeDiffMinutes = round(($currentTimestamp - $lastCommitTimestamp) / 60);

        if ($timeDiffMinutes >= 10) {
            // The last commit is 10 minutes ago or higher, proceed with triggering the workflow
            $payload = json_encode([
                'ref' => 'main', // Replace with the desired branch or commit reference
                'inputs' => (object) [], // Ensure that inputs is an object, even if empty
            ]);

            $ch = curl_init($workflowUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json',
                'Accept: application/vnd.github.v3+json',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36' // Replace with your User-Agent header value
            ]);

            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 204) {
                echo "Okay! Workflow run successfully triggered.\n";
            } else {
                echo "Oh! Failed to trigger workflow run. HTTP code: {$httpCode}\n";
                echo "Response: {$result}\n";
            }
        } else {
            echo "The last commit is not 10 minutes ago or higher.\n";
        }
    } else {
        echo "No commits found in the repository.\n";
    }
} else {
    echo "Failed to retrieve commit information. HTTP code: {$httpCode}\n";
    echo "Response: {$result}\n";
}
