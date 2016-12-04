<?php
namespace Deployer;
require 'recipe/common.php';

// Configuration

set('repository', 'git@github.com:QLJIANG/HelloWorld.git');
set('shared_files', []);
set('shared_dirs', []);
set('writable_dirs', []);

// Servers

server('production', 'qljiang.com')
    ->user('root')
    ->identityFile()
    ->set('deploy_path', '/data/code');


// Tasks

task('clone', function () {
    $res = run('pwd');
	writeln("Current dir: " . $res);
	$res = run("git clone {{repository}}");
	writeln("Current dir: " . $res);
});

task('pull', function () {
	$res = run('git pull origin master');
		
	writeln("Current dir: " . $res);
	
});

desc('Deploy your project');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

after('deploy', 'success');
