<?php

namespace Bestmomo\NiceArtisan\Http\Controllers;

use Bestmomo\NiceArtisan\Http\Kernel;

use AppController;
use Artisan;
use Illuminate\Http\Request;

use Illuminate\Foundation\Console\CommandMakeCommand;
use Illuminate\Foundation\Console\ConsoleMakeCommand;
use Illuminate\Routing\Console\ControllerMakeCommand;
use Illuminate\Foundation\Console\EventMakeCommand;
use Illuminate\Foundation\Console\JobMakeCommand;
use Illuminate\Foundation\Console\ListenerMakeCommand;
use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Illuminate\Foundation\Console\ModelMakeCommand;
use Illuminate\Foundation\Console\PolicyMakeCommand;
use Illuminate\Foundation\Console\ProviderMakeCommand;
use Illuminate\Foundation\Console\RequestMakeCommand;
use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Illuminate\Foundation\Console\TestMakeCommand;

use Illuminate\Database\Console\Migrations\InstallCommand;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Database\Console\Migrations\RefreshCommand;
use Illuminate\Database\Console\Migrations\ResetCommand;
use Illuminate\Database\Console\Migrations\RollbackCommand;
use Illuminate\Database\Console\Migrations\StatusCommand;

use Illuminate\Foundation\Console\RouteClearCommand;
use Illuminate\Foundation\Console\RouteCacheCommand;
use Illuminate\Foundation\Console\RouteListCommand;

use Illuminate\Queue\Console\FailedTableCommand;
use Illuminate\Queue\Console\FlushFailedCommand;
use Illuminate\Queue\Console\ForgetFailedCommand;
use Illuminate\Queue\Console\ListenCommand;
use Illuminate\Queue\Console\ListFailedCommand;
use Illuminate\Queue\Console\RestartCommand;
use Illuminate\Queue\Console\RetryCommand;
use Illuminate\Queue\Console\SubscribeCommand;
use Illuminate\Queue\Console\TableCommand;
use Illuminate\Queue\Console\WorkCommand;

use Illuminate\Foundation\Console\HandlerCommandCommand;
use Illuminate\Foundation\Console\HandlerEventCommand;

use Illuminate\Foundation\Console\ConfigCacheCommand;
use Illuminate\Foundation\Console\ConfigClearCommand;

use Illuminate\Cache\Console\CacheTableCommand;
use Illuminate\Cache\Console\ClearCommand;

use Illuminate\Foundation\Console\ClearCompiledCommand;
use Illuminate\Foundation\Console\OptimizeCommand;
use Illuminate\Foundation\Console\AppNameCommand;
use Illuminate\Auth\Console\ClearResetsCommand;
use Illuminate\Database\Console\Seeds\SeedCommand;
use Illuminate\Foundation\Console\EventGenerateCommand;
use Illuminate\Foundation\Console\KeyGenerateCommand;
use Illuminate\Console\Scheduling\ScheduleRunCommand;
use Illuminate\Session\Console\SessionTableCommand;
use Illuminate\Foundation\Console\VendorPublishCommand;
use Illuminate\Foundation\Console\DownCommand;
use Illuminate\Foundation\Console\EnvironmentCommand;

use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Migrations\Migrator;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Router;

class NiceArtisanController extends AppController
{
    /**
     * Create a new NiceArtisanController controller instance.
     *
     * @return void
     */
    public function __construct(Kernel $kernel)
    {
    	if($kernel->hasRouteMiddleware('nice_artisan')) {
        	$this->middleware('nice_artisan');
        }
    }

	/**
	 * Show the make commands.
	 *
	 * @return Response
	 */
	public function showMake(
			CommandMakeCommand $commandMakeCommand,
			ConsoleMakeCommand $consoleMakeCommand,
			ControllerMakeCommand $controllerMakeCommand,
			EventMakeCommand $eventMakeCommand,
			JobMakeCommand $jobMakeCommand,
			ListenerMakeCommand $listenerMakeCommand,
			MiddlewareMakeCommand $middlewareMakeCommand,
			MigrateMakeCommand $migrateMakeCommand,
			ModelMakeCommand $modelMakeCommand,
			PolicyMakeCommand $policyMakeCommand,
			ProviderMakeCommand $providerMakeCommand,
			RequestMakeCommand $RequestMakeCommand,
			SeederMakeCommand $seederMakeCommand,
			TestMakeCommand $testMakeCommand
		)
	{

		$items = [
			$commandMakeCommand,
			$consoleMakeCommand,
			$controllerMakeCommand,
			$eventMakeCommand,
			$jobMakeCommand,
			$listenerMakeCommand,
			$middlewareMakeCommand,
			$migrateMakeCommand,
			$modelMakeCommand,
			$policyMakeCommand,
			$providerMakeCommand,
			$RequestMakeCommand,
			$seederMakeCommand,
			$testMakeCommand
		];

		return view('NiceArtisan::index', compact('items'));
	}

	/**
	 * Show the migrate commands.
	 *
	 * @return Response
	 */
	public function showMigrate(
			DatabaseManager $databaseManager,
			Filesystem $filesystem,
			RefreshCommand $refreshCommand
		)
	{
		$databaseMigrationRepository = new DatabaseMigrationRepository($databaseManager, 'migration');

		$installCommand = new InstallCommand($databaseMigrationRepository);

		$migrator = new Migrator(
						$databaseMigrationRepository,
						$databaseManager,
						$filesystem
					);
		
		$resetCommand = new ResetCommand($migrator);
		$rollbackCommand = new RollbackCommand($migrator);
		$statusCommand = new StatusCommand($migrator);
		$migrateCommand = new MigrateCommand($migrator);

		$items = [
			$installCommand,
			$migrateCommand,
			$refreshCommand,
			$resetCommand,
			$rollbackCommand,
			$statusCommand
		];

		return view('NiceArtisan::index', compact('items'));
	}

	/**
	 * Show the route commands.
	 *
	 * @return Response
	 */
	public function showRoute(
			RouteClearCommand $routeClearCommand,
			RouteCacheCommand $routeCacheCommand,
			RouteListCommand $routeListCommand
		)
	{
		$items = [
			$routeClearCommand,
			$routeCacheCommand,
			$routeListCommand
		];

		return view('NiceArtisan::index', compact('items'));
	}

	/**
	 * Show the queue commands.
	 *
	 * @return Response
	 */
	public function showQueue(
			FailedTableCommand $failedTableCommand,
			FlushFailedCommand $flushFailedCommand,
			ForgetFailedCommand $forgetFailedCommand,
			//ListenCommand $listenCommand,
			ListFailedCommand $listFailedCommand,
			RestartCommand $restartCommand,
			RetryCommand $retryCommand,
			SubscribeCommand $subscribeCommand,
			TableCommand $tableCommand,
			WorkCommand $workCommand
		)
	{
		$items = [
			$failedTableCommand,
			$flushFailedCommand,
			$forgetFailedCommand,
			//$listenCommand,
			$listFailedCommand,
			$restartCommand,
			$retryCommand,
			$subscribeCommand,
			$tableCommand,
			$workCommand
		];

		return view('NiceArtisan::index', compact('items'));
	}

	/**
	 * Show the handler commands.
	 *
	 * @return Response
	 */
	public function showHandler(
			HandlerCommandCommand $handlerCommandCommand,
			HandlerEventCommand $handlerEventCommand
		)
	{
		$items = [
			$handlerCommandCommand,
			$handlerEventCommand
		];

		return view('NiceArtisan::index', compact('items'));
	}

	/**
	 * Show the config  commands.
	 *
	 * @return Response
	 */
	public function showConfig(
			ConfigCacheCommand $configCacheCommand,
			ConfigClearCommand $configClearCommand
		)
	{
		$items = [
			$configCacheCommand,
			$configClearCommand
		];

		return view('NiceArtisan::index', compact('items'));
	}

	/**
	 * Show the cache commands.
	 *
	 * @return Response
	 */
	public function showCache(
			CacheTableCommand $cacheTableCommand,
			ClearCommand $clearCommand
		)
	{
		$items = [
			$cacheTableCommand,
			$clearCommand
		];

		return view('NiceArtisan::index', compact('items'));
	}

	/**
	 * Show the miscellaneous commands.
	 *
	 * @return Response
	 */
	public function showMiscellaneous(
			DatabaseManager $databaseManager,
			ClearCompiledCommand $clearCompiledCommand,
			OptimizeCommand $optimizeCommand,
			AppNameCommand $appNameCommand,
			ClearResetsCommand $clearResetsCommand,
			EventGenerateCommand $eventGenerateCommand,
			KeyGenerateCommand $keyGenerateCommand,
			ScheduleRunCommand $scheduleRunCommand,
			SessionTableCommand $sessionTableCommand,
			VendorPublishCommand $vendorPublishCommand,
			DownCommand $downCommand,
			EnvironmentCommand $environmentCommand
		)
	{
		$seedCommand = new SeedCommand($databaseManager);

		$items = [
			$clearCompiledCommand,
			$optimizeCommand,
			$appNameCommand,
			$clearResetsCommand,
			$seedCommand,
			$eventGenerateCommand,
			$keyGenerateCommand,
			$scheduleRunCommand,
			$sessionTableCommand,
			$vendorPublishCommand,
			$downCommand,
			$environmentCommand
		];

		return view('NiceArtisan::index', compact('items'));
	}

	/**
	 * Call the Artisan make command
	 *
	 * @param  Request  $request
	 * @param  string $class
	 */
	public function make(Request $request, $command)
	{
		if(array_key_exists('argument_name', $request->all())) {
			$this->validate($request, ['argument_name' => 'required']);
		}

		if(array_key_exists('argument_id', $request->all())) {
			$this->validate($request, ['argument_id' => 'required']);
		}

		$inputs = $request->except('_token');

		$params = [];
		foreach ($inputs as $key => $value) {
			if($value != '') {
				$name = starts_with($key, 'argument') ? substr($key, 9) : '--' . substr($key, 7);
		 		$params[$name] = $value;	
		 	}
		}
		
		Artisan::call($command, $params);

		return redirect()->back()->with('output', Artisan::output());
	}
}