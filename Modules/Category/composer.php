<?php

// Dashboard ViewComposr
view()->composer([
  'category::dashboard.categories.*',
  'company::dashboard.companies.*',
], \Modules\Category\ViewComposers\Dashboard\CategoryComposer::class);
