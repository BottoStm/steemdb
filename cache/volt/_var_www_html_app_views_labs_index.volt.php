<!DOCTYPE html>
<html>
  <head>
  <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui' />
  <title>SteemDB - STEEM Blockchain Explorer</title>
  <?php if (isset($post)) { ?>
  <link rel="canonical" href="https://steemit.com/<?= $post->category ?>/@<?= $post->author ?>/<?= $post->permlink ?>"/>
  <?php } ?>
  <?php if (isset($posts) && isset($posts[0])) { ?>
  <link rel="canonical" href="https://steemit.com/<?= $posts[0]->category ?>/@<?= $posts[0]->author ?>/<?= $posts[0]->permlink ?>"/>
  <?php } ?>
  <style>
    .ui.vertical.sidebar.menu {
      padding-top: 3em !important;
    }
    body.pushable>.pusher {
      background: #efefef;
    }
    .ui.vertical.stripe {
      padding: 3em 0em;
    }
    .ui.vertical.stripe h3 {
      font-size: 2em;
    }
    .ui.vertical.stripe .button + h3,
    .ui.vertical.stripe p + h3 {
      margin-top: 3em;
    }
    .ui.vertical.stripe .floated.image {
      clear: both;
    }
    .ui.vertical.stripe p {
      font-size: 1.33em;
    }
    .ui.vertical.stripe .horizontal.divider {
      margin: 3em 0em;
    }
    .quote.stripe.segment {
      padding: 0em;
    }
    .quote.stripe.segment .grid .column {
      padding-top: 5em;
      padding-bottom: 5em;
    }
    .footer.segment {
      padding: 5em 0em;
    }
    .footer.segment a {
      color: #fff;
      text-decoration: underline;
    }
    .comment img,
    .markdown img {
      max-width: 100%;
      height:auto;
      display: block;
    }
    .markdown {
      font-size: 1.25em;
    }
    .markdown div.pull-left {
      float: left;
      padding-right: 1rem;
      max-width: 50%;
    }
    .markdown div.pull-right {
      float: right;
      padding-left: 1rem;
      max-width: 50%;
    }
    .markdown blockquote, .markdown blockquote p {
      line-height: 1.6;
      color: #8a8a8a;
    }
    .markdown blockquote {
      margin: 0 0 1rem;
      padding: .53571rem 1.19048rem 0 1.13095rem;
      border-left: 1px solid #cacaca;
    }
    .markdown code {
      white-space: pre;
      font-family: Consolas,Liberation Mono,Courier,monospace;
      display: block;
      padding: 10px;
      background: #f4f4f4;
      border-radius: 3px;
    }
    .ui.comments {
      max-width: auto;
    }
    .ui.comments .comment .comments {
      padding-left: 3em;
    }
    .definition.table td.wide {
      overflow-x: auto;
    }
    .ui.body.container {
      margin: 3em 0;
    }
    @media only screen and (min-width: 768px) {
      body .ui.table:not(.unstackable) tr>td.mobile.visible,
      body .ui.table:not(.unstackable) tr>th.mobile.visible,
      .mobile.visible {
        display: none
      }
    }
    @media only screen and (max-width: 767px) {
      .ui.tabular.menu {
        overflow-y: scroll;
      }
      body .ui.table:not(.unstackable) tr>td.mobile.hidden,
      body .ui.table:not(.unstackable) tr>th.mobile.hidden,
      .mobile.hidden {
        display: none !important;
      }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.css">
  <link rel="stylesheet" href="/bower/plottable/plottable.css">
</head>

  <body>

    <div class="ui fixed inverted blue main menu">
  <div class="ui container">
    <a class="launch icon item">
      <i class="content icon"></i>
    </a>

    <div class="right menu">
      <div class="ui category search item">
        <div class="ui icon input">
          <input class="prompt" type="text" placeholder="Search accounts...">
          <i class="search icon"></i>
        </div>
        <div class="results"></div>
      </div>
    </div>
  </div>
</div>
<!-- Following Menu -->
<div class="ui blue inverted top fixed mobile hidden menu">
  <div class="ui container">
    <div class="item" style="background: white">
      <div class="ui floating labeled dropdown">
        <img class="ui avatar image" style="border-radius: 0; width: 24px; height: 24px" src="https://steemdb.com/explorers/steem.png"/>
        <i class="dropdown black icon"></i>
        <div class="menu">
          <a class="active item" href="https://steemdb.com<?= strip_tags($this->router->getRewriteUri()) ?>">
            <img class="ui avatar image" style="border-radius: 0; width: 24px; height: 24px" src="https://steemdb.com/explorers/steem.png"/>
            steem
          </a>
          <a class="item" href="https://golosdb.com<?= strip_tags($this->router->getRewriteUri()) ?>">
            <img class="ui avatar image" style="border-radius: 0; width: 24px; height: 24px" src="https://steemdb.com/explorers/golos.jpg"/>
            golos
          </a>
          <a class="item" href="https://peerplaysdb.com<?= strip_tags($this->router->getRewriteUri()) ?>">
            <img class="ui avatar image" style="border-radius: 0; width: 24px; height: 24px" src="https://steemdb.com/explorers/ppy.png"/>
            peerplays
          </a>
          <a class="item" href="https://decent-db.com<?= strip_tags($this->router->getRewriteUri()) ?>">
            <img class="ui avatar image" style="border-radius: 0; width: 24px; height: 24px" src="https://steemdb.com/explorers/dct.png"/>
            decent
          </a>
          <a class="item" href="https://muse-db.com<?= strip_tags($this->router->getRewriteUri()) ?>">
            <img class="ui avatar image" style="border-radius: 0; width: 24px; height: 24px" src="https://steemdb.com/explorers/muse.png"/>
            muse
          </a>
        </div>
      </div>
    </div>
    <a href="/" class="header <?= (($this->router->getControllerName() == 'index') ? 'active' : '') ?> item">SteemDB</span>
    <a href="/accounts" class="<?= (($this->router->getControllerName() == 'account' || $this->router->getControllerName() == 'accounts') ? 'active' : '') ?> item">accounts</a>
    <a href="/apps" class="<?= (($this->router->getControllerName() == 'apps') ? 'active' : '') ?> item">apps</a>
    <a href="/comments/daily" class="<?= (($this->router->getControllerName() == 'comments') ? 'active' : '') ?> item">posts</a>
    <a href="/witnesses" class="<?= (($this->router->getControllerName() == 'witness') ? 'active' : '') ?> item">witnesses</a>
    <!-- <a href="https://blog.steemdb.com" class="item">updates</a> -->
    <a href="/labs" class="<?= (($this->router->getControllerName() == 'labs') ? 'active' : '') ?> item">labs</a>
    <div class="right menu">
      <div class="item">
        <a href="https://steemit.com/?r=jesta">
          <small>Create Account</small>
        </a>
      </div>
      <div class="ui category search item">
        <div class="ui icon input">
          <input class="prompt" type="text" placeholder="Search accounts...">
          <i class="search icon"></i>
        </div>
        <div class="results"></div>
      </div>
    </div>
  </div>
</div>

<!-- Sidebar Menu -->
<div class="ui vertical inverted sidebar menu">
  <a href="/" class="<?= (($this->router->getControllerName() == 'comment') ? 'active' : '') ?> item">posts</a>
  <a href="/accounts" class="<?= (($this->router->getControllerName() == 'account' || $this->router->getControllerName() == 'accounts') ? 'active' : '') ?> item">accounts</a>
  <a href="/witnesses" class="<?= (($this->router->getControllerName() == 'witness') ? 'active' : '') ?> item">witnesses</a>
 <!-- <a href="https://blog.steemdb.com" class="item">updates</a> -->
  <a href="/labs" class="<?= (($this->router->getControllerName() == 'labs') ? 'active' : '') ?> item">labs</a>
</div>


    <!-- Page Contents -->
    <div class="pusher" style="padding-top: 3em">

      


      



      <?php if ($this->flashSession->has()) { ?>
      <div class="ui container">
        <div class="ui error message">
          <?php $this->flashSession->output() ?>
        </div>
      </div>
      <?php } ?>

      
<style>
  .tooltip {
  /* keep tooltips from blocking interactions */
  pointer-events: none;
}
</style>
<div class="ui vertical stripe segment">
  <div class="ui middle aligned stackable grid container">
    <div class="row">
      <div class="column">
        <div class="ui huge header">
          SteemDB Labs
          <div class="sub header">
            Experimental projects and testing grounds for various concepts.
          </div>
        </div>
        <div class="ui segment">
          <div class="ui header">
            Active Experiments
            <div class="sub header">
              A list of the current experimental pages that really don't have a home on the site yet.
            </div>
          </div>
          <div class="ui divider"></div>
          <div class="ui divided relaxed list">
            <div class="item">
              <div class="ui header">
                <i class="list icon"></i>
                <div class="content">
                  <a href="/labs/pending">
                    Pending Payout Review
                  </a>
                  <div class="sub header">
                    Posts within their last 12hrslo where they can only receive downvotes.
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <i class="list icon"></i>
                <div class="content">
                  <a href="/labs/author">
                    Author Reward Leaderboard
                  </a>
                  <div class="sub header">
                    The highest earning authors per day.
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <i class="list icon"></i>
                <div class="content">
                  <a href="/labs/curation">
                    Curation Reward Leaderboard
                  </a>
                  <div class="sub header">
                    The highest earning curators per day.
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <i class="list icon"></i>
                <div class="content">
                  <a href="/labs/rshares">
                    rshare allocation by voter
                  </a>
                  <div class="sub header">
                    A day by day view of the voters who have contributed the most reward shares to all posts.
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <i class="list icon"></i>
                <div class="content">
                  <a href="/powerup">
                    biggest power ups
                  </a>
                  <div class="sub header">
                    The accounts who have powered up the most SP over the past 30 days.
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <i class="list icon"></i>
                <div class="content">
                  <a href="/labs/powerdown">
                    power down statistics
                  </a>
                  <div class="sub header">
                    Shows the largest accounts powering down as well as a week over week overview
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <i class="list icon"></i>
                <div class="content">
                  <a href="/labs/flags">
                    Account List by Flags Received
                  </a>
                  <div class="sub header">
                    Displays the top 200 most-flagged accounts
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <i class="list icon"></i>
                <div class="content">
                  <a href="/labs/conversions">
                    SBD Conversion History
                  </a>
                  <div class="sub header">
                    Most recent SBD -> STEEM Conversions
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <i class="list icon"></i>
                <div class="content">
                  <a href="/labs/clients">
                    Steem Client Usage
                  </a>
                  <div class="sub header">
                    Which steem clients are being used
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="ui segment">
          <div class="ui header">
            API Endpoints
            <div class="sub header">
              The available JSON endpoints available for consumption. Some of them are a bit slow. If you're looking to browse these with your browser, I'd recommend a <a href="https://github.com/tulios/json-viewer">json viewer</a>.
            </div>
          </div>
          <div class="ui divider"></div>
          <div class="ui divided relaxed list">
            <div class="item">
              <div class="ui header">
                <a href="/api/supply">
                  currency supply
                </a>
                <div class="sub header">
                  the sum of all balances in all accounts per day
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <a href="/api/props">
                  global props history
                </a>
                <div class="sub header">
                  a snapshot of the global properties of the blockchain every 6 hours
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <a href="/api/percentage">
                  percentage vesting
                </a>
                <div class="sub header">
                  the percentage of steem as vests
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <a href="/api/rshares">
                  voter rshares
                </a>
                <div class="sub header">
                  the reward shares allocated by voter, per day
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <a href="/api/downvotes">
                  downvoters
                </a>
                <div class="sub header">
                  the 20 most prolific downvoters per day
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <a href="/api/topwitnesses">
                  top 50 witnesses voters
                </a>
                <div class="sub header">
                  a list of the top 50 witnesses, each with details on the accounts voting for them
                </div>
              </div>
            </div>

            <div class="item">
              <div class="ui header">
                <a href="/api/rewards">
                  Daily Author Rewards (90-day)
                </a>
                <div class="sub header">
                  Daily totals of author rewards paid out over the last 90 days
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <a href="/api/curation">
                  Daily Curation Rewards (90-day)
                </a>
                <div class="sub header">
                  Daily totals of curation rewards paid out over the last 90 days
                </div>
              </div>
            </div>
            <div class="item">
              <div class="ui header">
                <a href="/api/topwitnesses">
                  STEEM -> VESTS per Day
                </a>
                <div class="sub header">
                  Total amount of STEEM powered up per day over the last 30 days
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



      <div class="ui container">
  <div class="ui basic very padded segment">
    <center>
      <small>
        * All Steem Power & VEST calculations are done using the current conversion rate, not a historical rate. This may cause some calculations to be incorrect.
      </small>
    </center>
  </div>
</div>
<div class="ui inverted vertical footer segment">
  <div class="ui container">
    <div class="ui stackable inverted divided equal height stackable grid">
      <div class="sixteen wide center aligned column">
        <h4 class="ui inverted header">
          created by @ray.wu
        </h4>
        <!-- <p>If you'd like to support this project, <a href="https://steemit.com/~witnesses">vote <strong>jesta</strong> as witness.</a></p> -->
      </div>
    </div>
  </div>
</div>


    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.js"></script>
<script type="text/javascript" src="/bower/d3/d3.min.js"></script>
<script type="text/javascript" src="/bower/plottable/plottable.min.js"></script>
<script type="text/javascript" src="/js/semantic-tablesort.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>


<script>
$(document)
  .ready(function() {

    $('.ui.category.search')
      .search({
        apiSettings: {
          url: '/search?q={query}'
        },
        debug: true,
        type: 'category'
      })
    ;

    $('.ui.sortable.table').tablesort();

    // create sidebar and attach to menu open
    $('.ui.sidebar')
      .sidebar('attach events', '.launch.item')
    ;

    $('.ui.dropdown')
      .dropdown({

      })
    ;

    $('[data-popup]')
      .popup({
        hoverable: true
      })
    ;

    $('.ui.dropdown.tags')
      .dropdown({
        onChange: function(value, text, $choice) {
          var selectedSort = $("#selectedSort").val(),
              selectedDate = $("#selectedDate").val();
          window.location.href = value + '/' + selectedSort + '/' + selectedDate;
        },
        apiSettings: {
          url: '/api/tags/{query}'
        }
      });

  })
;
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-81121004-2', 'auto');
  ga('send', 'pageview');

</script>

    

  </body>
</html>
