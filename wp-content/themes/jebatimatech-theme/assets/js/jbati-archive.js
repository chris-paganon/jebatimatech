jQuery(document).ready(function( $ ) {
  console.log(filters)
  console.log(solutions)

  for ( category in filters.categories) {
    console.log('category', category)
    $(`#filter-item-${category}`).click( (event) => {
      console.log('event', event);
      const activeSolutions = solutions.map( solution => {
        if ( solution.categories.some(c => c.term_id == event.target.value ) ) {
          console.log('success')
          solution.active = false
        } else {
          console.log('else')
          solution.active = true
        }
        return solution
      })
      console.log(activeSolutions)
    })
  }
})

// Loop through each filter
// Attach callback to each filter item
// Update active solutions array in the callback
// Hide & show solutions in the DOM according to the array