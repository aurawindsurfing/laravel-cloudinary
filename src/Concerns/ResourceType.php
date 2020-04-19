<?php

namespace Yoelpc4\LaravelCloudinary\Concerns;

class ResourceType implements ConcernAware
{
    /**
     * @var string
     */
    protected $resourceType = 'image';

    /**
     * @var string
     */
    protected $extension;

    /**
     * ResourceType constructor.
     *
     * @param  string  $extension
     * @see https://cloudinary.com/documentation/image_upload_api_reference#upload_method
     */
    public function __construct(string $extension)
    {
        $this->extension = $extension;
    }

    /**
     * @inheritDoc
     */
    public function handle()
    {
        $resourceTypes = config('filesystems.disks.cloudinary.resource_types', []);

        foreach ($resourceTypes as $resourceType => $extensions) {
            if (in_array($this->extension, $extensions)) {
                $this->resourceType = $resourceType;

                break;
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function value()
    {
        return $this->resourceType;
    }
}
