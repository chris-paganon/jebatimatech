jQuery(document).ready(function( $ ) {
  console.log('filters:', filters)
  console.log('solutions', solutions)

  filters.forEach(filter => {
    filter.filter_items.forEach( filter_item => {
      $(`#filter-${filter.slug} #filter-item-${filter_item.id}`).click( event => filterItemClicked(event) )
    })
  })

  function filterItemClicked(event) {
    // Update the 'active' value of filter_items instead. Then update solutions kind of like below. But each solution will need to be checked for every active filter_item.
    solutions = solutions.map( solution => {
      if ( solution.categories.some(c => c.term_id == event.target.value ) ) {
        solution.active = false
      } else {
        solution.active = true
      }
      return solution
    })
    console.log('filtered solutions', solutions)
  }
})

// Loop through each filter
// Attach callback to each filter item
// Update the 'active' value of filter_items
// Update the 'active' value of solutions from active filters
// Hide & show solutions in the DOM according to the solutions array