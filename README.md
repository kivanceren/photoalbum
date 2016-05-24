frontend\views\layouts\main.php içerisindeki Navbar kısmını aşağıdaki ile değiştirmeniz gerekmektedir.




     
    NavBar::begin([
        'brandLabel' => 'Application',
        'brandUrl' => Yii::$app->homeUrl.'?r=photoalbum%2Falbum%2Findex',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (!Yii::$app->user->isGuest) {
    $menuItems = [
         ['label' => 'Profil', 'url' => ['/photoalbum/user/update']],
        ['label' => 'Albümlerim', 'url' => ['/photoalbum/album/index']],
        ['label' => 'Arkadaşlarım', 'url' => ['/photoalbum/friends']],
        ['label' => 'Arkadaş Ekle', 'url' => ['/photoalbum/user']],
    ];}
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    
