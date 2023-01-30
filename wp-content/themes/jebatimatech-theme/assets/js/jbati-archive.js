jQuery(document).ready(function( $ ) {
  console.log('filters:', filters)
  console.log('solutions', solutions)

  filters.forEach(filter => {
    filter.filter_items.forEach( filter_item => {
      $(`#filter-${filter.slug} #filter-item-${filter_item.id}`).click( filter_item, () => {
        // Update active to true OR false
        filter_item.active = true
        filterItemClicked(filter_item)
      })
    })
  })

  function filterItemClicked(filter_item) {
    // Each solution needs to be checked for every active filter_item instead
    // const active_filters = getActiveFilters()
    solutions = solutions.map( solution => {
      // active_filters.forEach ...
      if ( solution.categories.some(c => c.term_id == filter_item.id ) ) {
        solution.active = false
      } else {
        solution.active = true
      }
      return solution
    })
    // update the DOM here
    // updateSolutions()
    console.log('filtered solutions', solutions)
    console.log('active filters', filters)
  }

  function getActiveFilters() {
    // To filter solutions easier
    return active_filters_only
  }

  function updateSolutions() {
    $('.solution-item').forEach( solution_item => {
      // get the id
      // check if active
      // update css class accordingly
    })
  }
})



// Loop through each filter
// Attach callback to each filter item
// Update the 'active' value of filter_items
// Update the 'active' value of solutions from active filters
// Hide & show solutions in the DOM according to the solutions array