# Get the script's directory path
$scriptPath = Split-Path -Parent $MyInvocation.MyCommand.Path

# Set $directory to resources\views directory path
$directory = Join-Path -Path $scriptPath -ChildPath "resources\views"

# Define the regex pattern to match __() with any string inside
$pattern = "__\('(.*?)'\)"

# Create an array to store formatted matches
$formattedMatches = @()

# Recursively get all files with .blade.php extension
$files = Get-ChildItem -Path $directory -Filter *.blade.php -Recurse

# Iterate through each file to find matches
foreach ($file in $files) {
    $content = Get-Content -Path $file.FullName -Raw
    $matches = [regex]::Matches($content, $pattern)

    # Store formatted matched strings in the array
    foreach ($match in $matches) {
        $formattedMatches += "`"$($match.Groups[1].Value)`" :  `"`REPLACE`","
    }
}

# Output formatted matches to strings.txt
$formattedMatches | Sort-Object -Unique | Out-File -FilePath (Join-Path -Path $scriptPath -ChildPath "strings.txt")
