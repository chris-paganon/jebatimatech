jQuery(document).ready(function( $ ) {
  console.log('filters:', filters)
  console.log('solutions', solutions)

  /**
   * Attach callback to each filter item
   */
  filters.forEach(filter => {
    filter.filter_items.forEach( filter_item => {
      $(`#filter-${filter.slug} #filter-item-${filter_item.id}`).click( (event) => {
        filter_item.active = event.target.checked
        filterItemClicked(filter)
      })
    })
  })


  /**
   * Update the 'active' value of solutions from active filters
   */
  function filterItemClicked(filterClicked) {
    solutions = solutions.map( solution => {
      solution.active = true
      filters.forEach( filter => {
        filter.filter_items.forEach( filter_item => {
          if ( filter_item.active === true && ! solution[filterClicked.slug].some(c => c.term_id == filter_item.id ) ) {
            solution.active = false
          }
        })
      })
      return solution
    })
    updateSolutions()
    console.log('filtered solutions', solutions)
    console.log('filters', filters)
  }

  
  /**
   * Update the DOM to show or hide solutions
   */
  function updateSolutions() {
    solutions.forEach( solution => {
      if (solution.active) {
        $(`.jbati-solution[data-solution-id="${solution.id}"]`).show()
      } else {
        $(`.jbati-solution[data-solution-id="${solution.id}"]`).hide()
      }
    })
  }
})



// Loop through each filter
// Attach callback to each filter item
// Update the 'active' value of filter_items
// Update the 'active' value of solutions from active filters
// Hide & show solutions in the DOM according to the solutions array