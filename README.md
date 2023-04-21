# Redirect From iFrame

This API requires setting the API URL in a variable as follows:
```php 
$apiURL = 'https://example.com/cache-api.php'; 
```

<br>

To use this API, you also need to create a directory called **cache** in the same directory where the **cache-api.php** file is located and set its permissions to **757**

```
chmod 757 /var/www/your-domain.com/cache
```

<br>

After setting up the server-side part, we need to add a **script** to the file from which the redirect should occur, which checks our transition in the iframe
```html
<script src="https://your-domain.com/cache-api.php?type=javascript"></script>
```

<br>

Now, in our iframe, we can add the following link to any button for redirect.
```html
<a href="https://your-domain.com/cache-api.php?type=write&url=https://google.com/">Redirect</a>
```

<br>

This way, in the main tab, you will be redirected to the page **https://google.com/**.
