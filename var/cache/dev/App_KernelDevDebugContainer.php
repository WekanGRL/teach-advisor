<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerKEmv9GL\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerKEmv9GL/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerKEmv9GL.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerKEmv9GL\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerKEmv9GL\App_KernelDevDebugContainer([
    'container.build_hash' => 'KEmv9GL',
    'container.build_id' => '818fca81',
    'container.build_time' => 1678441033,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerKEmv9GL');
