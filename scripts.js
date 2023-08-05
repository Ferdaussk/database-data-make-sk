console.log('JavaScript is working');

jQuery(document).ready(function($) {
  elementorFrontend.hooks.addAction('elementor/element/init', 'addCustomButtonToElementor', function($scope) {
    console.log('Elementor element initialized');
  });
});
