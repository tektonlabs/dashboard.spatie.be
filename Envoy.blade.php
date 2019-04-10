@setup
$projectDir = "/var/www/dashboard";
function logMessage($message) {
    return "echo '\033[32m" .$message. "\033[0m';\n";
}
@endsetup

@servers(['server' => ['ladmin@apus.tektonlabs.com']])

@story('deploy-code')
git
runComposer
runMigrations
runYarn
generateAssets
cleanCache
finishDeploy
@endstory

@story('deploy-fresh')
git
runComposer
runFreshMigrations
runYarn
generateAssets
cleanCache
finishDeploy
@endstory

@task('git')
{{ logMessage("🏃  Starting deployment...") }}
cd {{ $projectDir }}
git pull origin {{ $branch }}
@endtask

@task('runComposer')
{{ logMessage("🛠  Running composer...") }}
cd {{ $projectDir }}
composer install --no-dev --ignore-platform-reqs --prefer-dist --no-scripts -q -o;
@endtask

@task('runMigrations')
{{ logMessage("🥦  Running migrations...") }}
cd {{ $projectDir }}
php artisan migrate --force;
@endtask

@task('runFreshMigrations')
{{ logMessage("🥦  Running fresh migrations...") }}
cd {{ $projectDir }}
php artisan migrate:fresh --force --seed;
@endtask

@task('cleanCache')
{{ logMessage("✨  Cleaning cache...") }}
cd {{ $projectDir }}
php artisan clear-compiled;
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan view:cache
@endtask

@task('runYarn')
{{ logMessage("📦  Running Yarn...") }}
cd {{ $projectDir }}
yarn config set ignore-engines true
yarn --frozen-lockfile
yarn production
yarn
@endtask

@task('generate assets', ['on' => 'web'])
echo 'generating assets'
cd '{{ $pathOnServer }}'
yarn run production
@endtask

@task('bring app up', ['on' => 'web'])
cd '{{ $pathOnServer }}'
echo 'bringing app up'
php artisan up
@endtask

@task('reload php', ['on' => 'web'])
sudo service php7.3-fpm restart
sudo supervisorctl restart all
@endtask

@task('display success message', ['on' => 'localhost'])
echo "application successfully deployed"
@endtask

@task('generateAssets')
{{ logMessage("🌅  Generating assets...") }}
cd {{ $projectDir }};
yarn run production --progress false
@endtask

@task('finishDeploy')
{{ logMessage("🍻  Application deployed!") }}
@endtask
