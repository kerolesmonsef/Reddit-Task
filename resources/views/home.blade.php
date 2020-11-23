@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div id="search">
                            <h4>Search Reddit</h4>
                            <form id="search-form">
                                <div class="form-group">
                                    <input type="text" id="search-input" class="form-control mb-3"
                                           placeholder="Search Term...">
                                </div>
                                <h5 class="mt-2">Limit: </h5>
                                <div class="form-group">
                                    <select name="limit" id="limit" class="form-control">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="25" selected>25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-dark btn-block mt-4 class_search_button">Search
                                </button>
                            </form>
                        </div>
                    </div>


                    <div class="card-body" id="results">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        jQuery("#search-form").submit(function (e) {
            e.preventDefault()
            let limit = $("#limit").val();
            let q = $("#search-input").val();
            if (!q) {
                return;
            }
            search(q, limit);
        });


        function search(q, limit) {
            $.ajax(
                {
                    url: `https://www.reddit.com/search.json?q=${q}&limit=${limit}`,
                    success: function (result) {
                        let results = result.data.children
                        let output = '<div class="card-columns">';
                        console.log(results);
                        results.forEach(post_i => {
                            let post = post_i.data;
                            // Check for image
                            let image = post.preview
                                ? post.preview.images[0].source.url
                                : 'https://cdn.comparitech.com/wp-content/uploads/2017/08/reddit-1.jpg';
                            output += `
                              <div class="card mb-2">
                              <img class="card-img-top" src="${image}" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title">${post.title}</h5>
                                <p class="card-text">${truncateString(post.selftext, 100)}</p>
                                <a href="${post.url}" target="_blank" class="btn btn-primary">Read More</a>
                                <hr>
                                <span class="badge badge-secondary">Subreddit: ${post.subreddit}</span>
                                <span class="badge badge-dark">Score: ${post.score}</span>
                              </div>
                            </div>
                              `;
                        });
                        output += '</div>';
                        $("#results").children().remove();
                        $("#results").append(output);
                    }
                });

        }

        function truncateString(myString, limit) {
            const shortened = myString.indexOf(' ', limit);
            if (shortened == -1) return myString;
            return myString.substring(0, shortened);
        }
    </script>
@endpush
