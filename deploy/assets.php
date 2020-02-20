<?php

namespace Deployer;

desc('Build frontend assets locally');
task('assets:build', function () {
    if (!test('[ -d public/assets ]')) {
        run('{{bin/npm}} run cms:install');
    }
})->local();

desc('Upload your locally-built assets to your hosts');
task('assets:upload', function () {
    upload('public/assets/', '{{release_path}}/public/assets/');
    upload('public/mix-manifest.json', '{{release_path}}/public/mix-manifest.json');
});
