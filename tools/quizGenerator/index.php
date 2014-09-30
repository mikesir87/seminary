<!DOCTYPE html>
<html mozNoMarginBoxes>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Scripture Mastery Quiz Generator</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/sandstone/bootstrap.min.css" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
</head>
<body>

  <div class="navbar navbar-inverse hidden-print">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Blacksburg Seminary</a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/tools/">Back to Tools List</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="text-center hidden-print" style="padding-top:20px;" id="settings">
      <p>
        <a href="javascript:generateQuiz()" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Generate New Quiz</a> &nbsp;
        <a href="javascript:toggleAnswerGuide()" class="btn btn-success answerGuide"><i class="fa fa-check"></i> &nbsp;Show Answer Guide</a> &nbsp;
        <a href="javascript:toggleAnswerGuide()" class="btn btn-success quiz hide">
          <span class="fa-stack fa-sm">
            <i class="fa fa-check fa-stack-1x"></i>
            <i class="fa fa-ban fa-stack-2x"></i>
          </span> &nbsp;Hide Answer Guide
        </a> &nbsp;

        <a href="javascript:window.print()" class="btn btn-warning">
          <i class="fa fa-print"></i> &nbsp;Print
        </a>
      </p>
      <p class="chrome hide"><strong>Print tip:</strong> When printing from Chrome, uncheck the "Headers and Footers" box in the print dialog.</p>
      <p class="safari hide"><strong>Print tip:</strong> When printing from Safari, uncheck the "Print Headers and Footers" box in the print dialog to hide the URL and page number.</p>
      <hr />
    </div>

    <h1 class="text-center">D&C Scripture Mastery Quiz</h1>
    <table class="table table-condensed">
      <thead>
        <tr>
          <th style="width:50px;"></th>
          <th>References</th>
          <th>Keywords</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

  <div class="container text-center hidden-print" style="padding-top:25px;padding-bottom:25px;border-top:1px solid #eee;">
    <small>This site is not officially affiliated with The Church of Jesus Christ of Latter-Day Saints.  It is only a site by a member of the church as a resource to others.</small>
  </div>

  <script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>
  
  <script>
    (function(){var p=[],w=window,d=document,e=f=0;p.push('ua='+encodeURIComponent(navigator.userAgent));e|=w.ActiveXObject?1:0;e|=w.opera?2:0;e|=w.chrome?4:0;
    e|='getBoxObjectFor' in d || 'mozInnerScreenX' in w?8:0;e|=('WebKitCSSMatrix' in w||'WebKitPoint' in w||'webkitStorageInfo' in w||'webkitURL' in w)?16:0;
    e|=(e&16&&({}.toString).toString().indexOf("\n")===-1)?32:0;p.push('e='+e);f|='sandbox' in d.createElement('iframe')?1:0;f|='WebSocket' in w?2:0;
    f|=w.Worker?4:0;f|=w.applicationCache?8:0;f|=w.history && history.pushState?16:0;f|=d.documentElement.webkitRequestFullScreen?32:0;f|='FileReader' in w?64:0;
    p.push('f='+f);p.push('r='+Math.random().toString(36).substring(7));p.push('w='+screen.width);p.push('h='+screen.height);var s=d.createElement('script');
    s.src='//api.whichbrowser.net/dev/detect.js?' + p.join('&');d.getElementsByTagName('head')[0].appendChild(s);})();
  </script>

  <script type="text/javascript">
    var rawSmData = null;

    $(function() {
      if (localStorage.getItem("lastQuiz") == null)
        generateQuiz();
      else {
        var lastQuizData = JSON.parse(localStorage.getItem("lastQuiz"));
        handleSMData(lastQuizData.ordered, lastQuizData.shuffled);
      }
    });

    function generateQuiz() {
      if (rawSmData != null)
        handleRawSmData(rawSmData);
      else {
        $.get("sm.php", function(smData) { 
          rawSmData = smData;
          handleRawSmData(smData);
        }, 'json');
      }
    }

    function handleRawSmData(smData) {
        var data = { ordered : smData, shuffled : shuffle(smData) };
        handleSMData(data.ordered, data.shuffled);
        localStorage.setItem("lastQuiz", JSON.stringify(data));       
    }

    function shuffle(originalArray) {
      var array = originalArray.slice(0);
      var currentIndex = array.length, temporaryValue, randomIndex ;

      while (0 !== currentIndex) {
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
      }

      return array;
    }

    function handleSMData(masteryInOrder, shuffledMastery) {
      var $table = $("table tbody").html('');
      for (var i = 0; i < masteryInOrder.length; i++) {
        $table.append("<tr><td class='text-center'><span class='quiz'>_____</span><span class='answerGuide hide'>__<span class='answer'></span>__</span></td><td>" + masteryInOrder[i].reference + "</td><td></td></tr>");
      }
      for (var i = 0; i < shuffledMastery.length; i++) {
        $table.find("tr:eq(" + shuffledMastery[i].index + ") td .answer").text(i + 1);
        $table.find("tr:eq(" + i + ") td:eq(2)").text((i+1) + ". " + shuffledMastery[i].phrase);
      }
      if ($("#settings .answerGuide").hasClass("hide")) {
        $("table .quiz").addClass("hide");
        $("table .answerGuide").removeClass("hide");
      }
    }

    function toggleAnswerGuide() {
      $(".answerGuide, .quiz").toggleClass("hide");
    }

    $(function() {
      checkBrowser();
    })

    function checkBrowser() {
      if (typeof WhichBrowser != "undefined")
        doBrowserCheck();
      else
        setTimeout(checkBrowser, 100);
    }

    function doBrowserCheck() {
      browserData = new WhichBrowser();
      if (browserData.browser.name == 'Chrome') {
        $(".chrome").removeClass("hide");
      } else if (browserData.browser.name == "Safari") {
        $(".safari").removeClass("hide");
      }
    }
  </script>
</body>
</html>