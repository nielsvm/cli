<?php

namespace Acquia\Ads\Command\Ide;

use Acquia\Ads\Exec\ExecTrait;
use AcquiaCloudApi\Endpoints\Ides;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateProjectCommand
 *
 * @package Grasmash\YamlCli\Command
 */
class IdeDeleteCommand extends IdeCommandBase
{

    use ExecTrait;

    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this->setName('ide:delete')->setDescription('Delete an IDE');
        // @todo Add option to accept an IDE label or UUID.
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int 0 if everything went fine, or an exit code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $acquia_cloud_client = $this->getAcquiaCloudClient();
        $ides_resource = new Ides($acquia_cloud_client);

        $ide_uuid = $this->promptIdeChoice("Please select the IDE you'd like to delete:", $ides_resource);
        $response = $ides_resource->delete($ide_uuid);
        $this->output->writeln($response->message);

        return 0;
    }
}