<!doctype html>
<html>
  <head>
    <title>Left Slidebar Only Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- Slidebars CSS -->
    <link rel="stylesheet" href="/css/slidebars.min.css">
    
    <!-- Example Styles -->
    <link rel="stylesheet" href="/css/aiwtc.css">
  </head>
  
  <body>  
    <div id="sb-site">
      <h1>Left Slidebar Only Example</h1>
      <p>This example only uses the left Slidebar. The usual control classes are here for testing purposes.</p>
      <ul>
        <li class="sb-toggle-left">Toggle left Slidebar</li>
      </ul>
      
      <h2>More Examples</h2>
      <ul>
        <li><a href="control-classes.html">Control Classes</a></li>
        <li><a href="api-usage.html">API Usage</a></li>
        <li><a href="mobile-only.html">Mobile Only</a></li>
        <li><a href="animation-styles.html">Animation Styles</a></li>
        <li><a href="optional-widths.html">Optional Widths</a></li>
        <li><a href="custom-widths.html">Custom Widths</a></li>
        <li><a href="static-slidebars.html">Static Slidebars</a></li>
        <li><a href="left-slidebar-only.html">Left Slidebar Only</a></li>
        <li><a href="right-slidebar-only.html">Right Slidebar Only</a></li>
      </ul>
    </div>
    
    <div class="sb-slidebar sb-left">
      <p>test</p>
    </div>
        
    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
    <!-- Slidebars -->
    <script src="/js/slidebars.min.js"></script>
    <script>
      (function($) {
        $(document).ready(function() {
          $.slidebars();
        });
      }) (jQuery);
    </script>
  </body>
</html>