jQuery(document).ready(function( $ ) {
  console.log('filters:', filters)
  console.log('solutions', solutions)

  /**
   * Attach callback to each filter item
   */
  filters.forEach(filter => {
    filter.filter_items.forEach( filter_item => {
      $(`#filter-${filter.slug} #filter-item-${filter_item.slug}`).click( (event) => {
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
          if ( 
            filter_item.active === true
            && ! solution.properties.find(
                property => property.slug == filterClicked.slug
              ).values.some(
                value => value.slug == filter_item.slug 
              )
            ) {
            solution.active = false
          }
        })
      })
      return solution
    })
    updateSolutions()
  }

  
  /**
   * Update the DOM to show or hide solutions
   */
  function updateSolutions() {
    solutions.forEach( solution => {
      if (solution.active) {
        $(`.jbati-solution[data-solution-id="${solution.id}"]`).addClass('active')
      } else {
        $(`.jbati-solution[data-solution-id="${solution.id}"]`).removeClass('active')
      }
    })
  }
})