var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

document.querySelectorAll('.tooltip-tab').forEach(el => {
  const tooltip = bootstrap.Tooltip.getInstance(el);
  if (tooltip) tooltip.dispose();
  new bootstrap.Tooltip(el);
});
