<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/forms@0.3.4/dist/forms.min.css">
    <link rel='stylesheet' id='wp-block-library-css' href='https://www.feu.edu.ph/wp-includes/css/dist/block-library/style.min.css?ver=6.7.1' type='text/css' media='all' />
<style id='wp-block-library-theme-inline-css' type='text/css'>
.wp-block-audio :where(figcaption){color:#555;font-size:13px;text-align:center}.is-dark-theme .wp-block-audio :where(figcaption){color:#ffffffa6}.wp-block-audio{margin:0 0 1em}.wp-block-code{border:1px solid #ccc;border-radius:4px;font-family:Menlo,Consolas,monaco,monospace;padding:.8em 1em}.wp-block-embed :where(figcaption){color:#555;font-size:13px;text-align:center}.is-dark-theme .wp-block-embed :where(figcaption){color:#ffffffa6}.wp-block-embed{margin:0 0 1em}.blocks-gallery-caption{color:#555;font-size:13px;text-align:center}.is-dark-theme .blocks-gallery-caption{color:#ffffffa6}:root :where(.wp-block-image figcaption){color:#555;font-size:13px;text-align:center}.is-dark-theme :root :where(.wp-block-image figcaption){color:#ffffffa6}.wp-block-image{margin:0 0 1em}.wp-block-pullquote{border-bottom:4px solid;border-top:4px solid;color:currentColor;margin-bottom:1.75em}.wp-block-pullquote cite,.wp-block-pullquote footer,.wp-block-pullquote__citation{color:currentColor;font-size:.8125em;font-style:normal;text-transform:uppercase}.wp-block-quote{border-left:.25em solid;margin:0 0 1.75em;padding-left:1em}.wp-block-quote cite,.wp-block-quote footer{color:currentColor;font-size:.8125em;font-style:normal;position:relative}.wp-block-quote:where(.has-text-align-right){border-left:none;border-right:.25em solid;padding-left:0;padding-right:1em}.wp-block-quote:where(.has-text-align-center){border:none;padding-left:0}.wp-block-quote.is-large,.wp-block-quote.is-style-large,.wp-block-quote:where(.is-style-plain){border:none}.wp-block-search .wp-block-search__label{font-weight:700}.wp-block-search__button{border:1px solid #ccc;padding:.375em .625em}:where(.wp-block-group.has-background){padding:1.25em 2.375em}.wp-block-separator.has-css-opacity{opacity:.4}.wp-block-separator{border:none;border-bottom:2px solid;margin-left:auto;margin-right:auto}.wp-block-separator.has-alpha-channel-opacity{opacity:1}.wp-block-separator:not(.is-style-wide):not(.is-style-dots){width:100px}.wp-block-separator.has-background:not(.is-style-dots){border-bottom:none;height:1px}.wp-block-separator.has-background:not(.is-style-wide):not(.is-style-dots){height:2px}.wp-block-table{margin:0 0 1em}.wp-block-table td,.wp-block-table th{word-break:normal}.wp-block-table :where(figcaption){color:#555;font-size:13px;text-align:center}.is-dark-theme .wp-block-table :where(figcaption){color:#ffffffa6}.wp-block-video :where(figcaption){color:#555;font-size:13px;text-align:center}.is-dark-theme .wp-block-video :where(figcaption){color:#ffffffa6}.wp-block-video{margin:0 0 1em}:root :where(.wp-block-template-part.has-background){margin-bottom:0;margin-top:0;padding:1.25em 2.375em}
</style>
<style id='classic-theme-styles-inline-css' type='text/css'>
/*! This file is auto-generated */
.wp-block-button__link{color:#fff;background-color:#32373c;border-radius:9999px;box-shadow:none;text-decoration:none;padding:calc(.667em + 2px) calc(1.333em + 2px);font-size:1.125em}.wp-block-file__button{background:#32373c;color:#fff;text-decoration:none}
</style>
<style id='global-styles-inline-css' type='text/css'>
:root{--wp--preset--aspect-ratio--square: 1;--wp--preset--aspect-ratio--4-3: 4/3;--wp--preset--aspect-ratio--3-4: 3/4;--wp--preset--aspect-ratio--3-2: 3/2;--wp--preset--aspect-ratio--2-3: 2/3;--wp--preset--aspect-ratio--16-9: 16/9;--wp--preset--aspect-ratio--9-16: 9/16;--wp--preset--color--black: #000000;--wp--preset--color--cyan-bluish-gray: #abb8c3;--wp--preset--color--white: #ffffff;--wp--preset--color--pale-pink: #f78da7;--wp--preset--color--vivid-red: #cf2e2e;--wp--preset--color--luminous-vivid-orange: #ff6900;--wp--preset--color--luminous-vivid-amber: #fcb900;--wp--preset--color--light-green-cyan: #7bdcb5;--wp--preset--color--vivid-green-cyan: #00d084;--wp--preset--color--pale-cyan-blue: #8ed1fc;--wp--preset--color--vivid-cyan-blue: #0693e3;--wp--preset--color--vivid-purple: #9b51e0;--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%);--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%);--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%);--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%);--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%);--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%);--wp--preset--gradient--blush-light-purple: linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%);--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%);--wp--preset--gradient--luminous-dusk: linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%);--wp--preset--gradient--pale-ocean: linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%);--wp--preset--gradient--electric-grass: linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%);--wp--preset--gradient--midnight: linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%);--wp--preset--font-size--small: 13px;--wp--preset--font-size--medium: 20px;--wp--preset--font-size--large: 36px;--wp--preset--font-size--x-large: 42px;--wp--preset--spacing--20: 0.44rem;--wp--preset--spacing--30: 0.67rem;--wp--preset--spacing--40: 1rem;--wp--preset--spacing--50: 1.5rem;--wp--preset--spacing--60: 2.25rem;--wp--preset--spacing--70: 3.38rem;--wp--preset--spacing--80: 5.06rem;--wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);--wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);--wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);--wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);--wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);}:where(.is-layout-flex){gap: 0.5em;}:where(.is-layout-grid){gap: 0.5em;}body .is-layout-flex{display: flex;}.is-layout-flex{flex-wrap: wrap;align-items: center;}.is-layout-flex > :is(*, div){margin: 0;}body .is-layout-grid{display: grid;}.is-layout-grid > :is(*, div){margin: 0;}:where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}:where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}.has-black-color{color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-color{color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-color{color: var(--wp--preset--color--white) !important;}.has-pale-pink-color{color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-color{color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-color{color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-color{color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-color{color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-color{color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-color{color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-color{color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-color{color: var(--wp--preset--color--vivid-purple) !important;}.has-black-background-color{background-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-background-color{background-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-background-color{background-color: var(--wp--preset--color--white) !important;}.has-pale-pink-background-color{background-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-background-color{background-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-background-color{background-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-background-color{background-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-background-color{background-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-background-color{background-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-background-color{background-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-background-color{background-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-background-color{background-color: var(--wp--preset--color--vivid-purple) !important;}.has-black-border-color{border-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-border-color{border-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-border-color{border-color: var(--wp--preset--color--white) !important;}.has-pale-pink-border-color{border-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-border-color{border-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-border-color{border-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-border-color{border-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-border-color{border-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-border-color{border-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-border-color{border-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-border-color{border-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-border-color{border-color: var(--wp--preset--color--vivid-purple) !important;}.has-vivid-cyan-blue-to-vivid-purple-gradient-background{background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;}.has-light-green-cyan-to-vivid-green-cyan-gradient-background{background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;}.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;}.has-luminous-vivid-orange-to-vivid-red-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;}.has-very-light-gray-to-cyan-bluish-gray-gradient-background{background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;}.has-cool-to-warm-spectrum-gradient-background{background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;}.has-blush-light-purple-gradient-background{background: var(--wp--preset--gradient--blush-light-purple) !important;}.has-blush-bordeaux-gradient-background{background: var(--wp--preset--gradient--blush-bordeaux) !important;}.has-luminous-dusk-gradient-background{background: var(--wp--preset--gradient--luminous-dusk) !important;}.has-pale-ocean-gradient-background{background: var(--wp--preset--gradient--pale-ocean) !important;}.has-electric-grass-gradient-background{background: var(--wp--preset--gradient--electric-grass) !important;}.has-midnight-gradient-background{background: var(--wp--preset--gradient--midnight) !important;}.has-small-font-size{font-size: var(--wp--preset--font-size--small) !important;}.has-medium-font-size{font-size: var(--wp--preset--font-size--medium) !important;}.has-large-font-size{font-size: var(--wp--preset--font-size--large) !important;}.has-x-large-font-size{font-size: var(--wp--preset--font-size--x-large) !important;}
:where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}
:where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}
:root :where(.wp-block-pullquote){font-size: 1.5em;line-height: 1.6;}
</style>
<link rel='stylesheet' id='feu-plugins-css' href='https://www.feu.edu.ph/wp-content/themes/feu_2023/assets/css/plugins.css?ver=4.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='feu-style-css' href='https://www.feu.edu.ph/wp-content/themes/feu_2023/assets/css/style.css?ver=6.7.1' type='text/css' media='all' />
<link rel='stylesheet' id='feu-dellarobb-css' href='https://www.feu.edu.ph/wp-content/themes/feu_2023/assets/fonts/delarobb/delarobb.css?ver=6.7.1' type='text/css' media='all' />
<link rel="https://api.w.org/" href="https://www.feu.edu.ph/wp-json/" /><link rel="alternate" title="JSON" type="application/json" href="https://www.feu.edu.ph/wp-json/wp/v2/pages/3047" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://www.feu.edu.ph/xmlrpc.php?rsd" />
<meta name="generator" content="WordPress 6.7.1" />
<link rel='shortlink' href='https://www.feu.edu.ph/' />
<link rel="alternate" title="oEmbed (JSON)" type="application/json+oembed" href="https://www.feu.edu.ph/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.feu.edu.ph%2F" />
<link rel="alternate" title="oEmbed (XML)" type="text/xml+oembed" href="https://www.feu.edu.ph/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.feu.edu.ph%2F&#038;format=xml" />
<link rel="apple-touch-icon" href="https://www.feu.edu.ph/wp-content/uploads/2023/03/favicon.ico" />
<meta name="msapplication-TileImage" content="https://www.feu.edu.ph/wp-content/uploads/2023/03/favicon.ico" />
    <title>Tamsakay</title>
    <link rel="icon" type="image/x-icon" href="/Tamsakay/Tamsakay Logo.png">
    <style>
        /* Custom styles */
        body {
            background-color: #f5f8fa; /* Light background color */
            font-family: 'Arial', sans-serif;
        }
        body::-webkit-scrollbar{
            display:none;
        }

        .header-image {
            width: 140px;
            margin: 0 auto;
        }

        h4 {
            font-size: 1.5rem;
            color: #0f172a; /* Text color */
            font-weight: 700;
            text-align: center;
            margin-top: 1rem;
        }

        .button-container {
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button-container a button {
            background-color: #047857; /* Primary green */
            color: white;
            font-size: 1rem;
            font-weight: bold;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }

        .button-container a button:hover {
            background-color: #065f46; /* Darker green on hover */
        }



        /* Responsive Design */
        @media (min-width: 768px) {
            h4 {
                font-size: 2rem;
            }

            .button-container a button {
                font-size: 1.25rem;
                padding: 1rem 2.5rem;
            }
        }
        figure img {
    width: 170%;
    max-width: 170%;
    height: auto !important;
   
}
img, svg {
    vertical-align: middle;
    max-width: 320px;
    
}
footer {
            margin-top: 20px;
            text-align: center;
            background-color: #05693B;
            color: white;
            padding: 47px;
            width: 100%;
            font-size: 14px;
            text-shadow: 1px 1px 2px black;
        }

    </style>
</head>
<body>
    <br><br><br><br><br><br> <br><br><br> <!-- para sa space taena-->
<nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
          <div class="navbar-brand w-100">
            <a href="https://feucavite.edu.ph/">
            

                
              <img src="https://www.feucavite.edu.ph/wp-content/uploads/2023/12/feucavite-newseal71522-2.png" srcset="https://www.feu.edu.ph/wp-content/themes/feu_2023/assets/img/logo@2x.png 2x" alt="" />
            </a>
          </div>
          
          <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
            <div class="offcanvas-header d-lg-none">
              <a href="https://www.feu.edu.ph"><img src="https://www.feu.edu.ph/wp-content/themes/feu_2023/assets/img/logo-light.png" srcset="https://www.feu.edu.ph/wp-content/themes/feu_2023/assets/img/logo-light@2x.png 2x" alt="" /></a>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
</div>
</div>
</nav>
      
     
   

    <div class="content-wrapper">

    <div class="card bg-soft-primary">
          <div class="card-body p-md-10 py-xxl-15 position-relative">
            <div class="position-absolute d-none d-lg-block" style="bottom:0; left:0%; width: 28%; z-index:2">
              <figure><img src="/Tamsakay/Tamsakay Logo.png" srcset="https://www.feu.edu.ph/wp-content/themes/feu_2023/assets/img/photos/co2@2x.png 2x" alt=""></figure>
            </div>
            <div class="row gx-md-0 gx-xl-12 text-center">
              <div class="col-lg-7 offset-lg-5 col-xl-6">
                <h1 class="display-1 delarobb mb-5">Tamsakay Shuttle Service</h1>
                <h3>Ride Like a Tamaraw: Strong, Fast, and Furious!</h3>
                <blockquote class="border-0 fs-lg mb-0">
                  <p>Tamsakay Shuttle Service is a web application designed to keep students informed about their shuttle driver's status. Whether the driver is on their way, unavailable, or taking a break, you will always be updated in real-time. While waiting for your shuttle, you can also enjoy fun mini-games to pass the time.
                  To get started, please register to access all features of the Tamsakay Shuttle Service. Your journey begins here!</p>
                  <div class="blockquote-details justify-content-center text-center">
                    <a href="login_user.php" class="btn btn-outline-primary rounded-pill">Log in to Tamskakay here</a>
                  </div>
                  <div class="blockquote-details justify-content-center text-center">
                    <a href="registration_user.php" class="btn btn-outline-primary rounded-pill">Register to Tamskakay here</a>
                  </div>
                </blockquote>
              </div>
              <!-- /column -->
            </div>
            <!-- /.row -->
          </div>
          <!--/.card-body -->
        </div>
        <!--/.card -->
        <footer>
    &copy; 2024 Tamsakay. All rights reserved.
</footer>
</body>
</html>
