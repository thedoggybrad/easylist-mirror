<?php

// Replace with your repository owner, repository name, and workflow name
$repositoryOwner = 'OWNER';
$repositoryName = 'REPO';
$workflowName = 'FILE';

// GitHub Personal Access Token with repo scope (replace with your actual token)
$token = $_ENV['VARIABLE'];

// Username and Password for basic authentication
$username = 'username';
$password = 'password';

// Check if username and password are provided in the request
if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== $username || $_SERVER['PHP_AUTH_PW'] !== $password) {
    header('WWW-Authenticate: Basic realm="GitHub Workflow Trigger"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Authentication required.';
    exit;
}

// GitHub API URLs
$apiUrl = "https://api.github.com/repos/{$repositoryOwner}/{$repositoryName}/actions/workflows";
$workflowUrl = "{$apiUrl}/{$workflowName}/dispatches";
$commitUrl = "https://api.github.com/repos/{$repositoryOwner}/{$repositoryName}/commits?per_page=1";

// Function to perform a GET request
function getRequest($url, $token) {
    $options = [
        "http" => [
            "header" => [
                "Authorization: Bearer $token",
                "Content-Type: application/json",
                "Accept: application/vnd.github.v3+json",
                "User-Agent: Your-App-Name" // Replace with your User-Agent header value
            ]
        ]
    ];

    $context = stream_context_create($options);
    return file_get_contents($url, false, $context);
}

// Retrieve the last commit information
$result = getRequest($commitUrl, $token);
$httpCode = $result === false ? 500 : 200; // Simple error handling

if ($httpCode === 200) {
    $commits = json_decode($result, true);

    if (!empty($commits)) {
        $lastCommitTimestamp = strtotime($commits[0]['commit']['committer']['date']);
        $currentTimestamp = time();
        $timeDiffMinutes = round(($currentTimestamp - $lastCommitTimestamp) / 60);

        if ($timeDiffMinutes >= 1) {
            // Safeguard to prevent accidental failures
            $payload = json_encode([
                'ref' => 'main', // Replace with the desired branch or commit reference
                'inputs' => (object) [],
            ]);

            // Function to perform a POST request
            function postRequest($url, $payload, $token) {
                $options = [
                    "http" => [
                        "header" => [
                            "Authorization: Bearer $token",
                            "Content-Type: application/json",
                            "Accept: application/vnd.github.v3+json",
                            "User-Agent: Your-App-Name" // Replace with your User-Agent header value
                        ],
                        "method" => "POST",
                        "content" => $payload
                    ]
                ];

                $context = stream_context_create($options);
                return file_get_contents($url, false, $context);
            }

            // Trigger the workflow
            $result = postRequest($workflowUrl, $payload, $token);
            $httpCode = $result === false ? 500 : 204; // Simplified HTTP status handling

            if ($httpCode === 204) {
                echo "Workflow run successfully triggered.\n";
            } else {
                echo "Failed to trigger workflow run. HTTP code: {$httpCode}\n";
                echo "Response: {$result}\n";
            }
        } else {
            echo "The last commit is not 1 minute ago or higher.\n";
        }
    } else {
        echo "No commits found in the repository.\n";
    }
} else {
    echo "Failed to retrieve commit information. HTTP code: {$httpCode}\n";
    echo "Response: {$result}\n";
}
?>