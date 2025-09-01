<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php echo $title ?? 'SEO Virtual Assistant'; ?></title>
    <meta name="description" content="<?php echo $description ?? 'Optimize your website for search engines with our powerful team.'; ?>" />

    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css" />

    <?php if (isset($stylesheets) && is_array($stylesheets)): ?>
        <?php foreach ($stylesheets as $stylesheet): ?>
            <link rel="stylesheet" href="<?php echo $stylesheet; ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($headjs) && is_array($headjs)): ?>
        <?php foreach ($headjs as $script): ?>
            <script src="<?php echo $script; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php include __DIR__ . '/partials/seo.php'; ?>
</head>

<body>

    <!-- Main Content -->
    <?php echo $content ?? ''; ?>

    <!-- Footer -->
    <footer class="mt-auto">
        <?php include __DIR__ . '/partials/footer.php'; ?>
    </footer>

    <?php if (isset($javascript) && is_array($javascript)): ?>
        <?php foreach ($javascript as $script): ?>
            <script defer src="<?php echo $script; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>