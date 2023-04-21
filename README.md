# Redirect From iFrame
API code for creating and viewing cache files on the server, and an iFrame example for redirecting a user to a different website.
⋅⋅* Checks for the presence of GET parameter 'type'
⋅⋅* If 'type' is 'write', creates a new cache file with the specified URL, if it was passed in the GET parameter 'url'
⋅⋅* If 'type' is 'view', checks for the existence of a cache file and outputs its content if the file exists. Then the cache file is deleted.
⋅⋅* If 'type' is 'javascript', outputs JavaScript code that periodically requests the API to check for the existence of a cache file, and if it exists, redirects the user to the URL that was saved in the cache file.
