// // start sidebar
// document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
//     item.addEventListener('click', function (e) {
//         e.preventDefault()
//         const parent = item.closest('.group')
//         if (parent.classList.contains('selected')) {
//             parent.classList.remove('selected')
//         } else {
//             // document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
//             //     i.closest('.group').classList.remove('.selected')
//             // })
//             parent.classList.add('selected')
//         }
//     })
// })
// // end sidebar 


// // start menu bar
// document.querySelectorAll('.dropdown-menu-toggle').forEach(function (item) {
//     item.addEventListener('click', function (e) {
//         e.preventDefault()
//         const parent = item.closest('.group')
//         if (parent.classList.contains('selected')) {
//             parent.classList.remove('selected')
//         } else {
//             // document.querySelectorAll('.dropdown-menu-toggle').forEach(function (i) {
//             //     i.closest('.group').classList.remove('.selected')
//             // })
//             document.querySelectorAll('.nav-item.selected').forEach(function (openedGroup) {
//                 openedGroup.classList.remove('selected');
//             });
//             parent.classList.add('selected')
//         }
//     })
// })

// document.addEventListener('click', function (e) {
//     if (!e.target.closest('.group')) {
//         document.querySelectorAll('.nav-item.selected').forEach(function (openedGroup) {
//             openedGroup.classList.remove('selected');
//         });
//     }
// });
// // end menu bar

