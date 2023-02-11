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
        filterItemClicked()
      })
    })
  })

  /**
   * Update the 'active' value of solutions from active filters
   */
  function filterItemClicked() {
    solutions = solutions.map( solution => {
      solution.active = true
      filters.forEach( filter => {
        filter.filter_items.forEach( filter_item => {
          const matching_property = solution.properties.find( property => property.slug == filter.slug )
          if ( filter_item.active === true && matching_property && ! matching_property.values.some(value => value.slug == filter_item.slug) ) {
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

  /**
   * Accordeon for filters
   */
  $('.jbati-accordion-button').click( (event) => {
    console.log(event.target);
    $(event.target).siblings('.jbati-accordion-content').toggleClass('active')
  })
})