const fetch_countries = async () => {
  try {
    const url = "https://restcountries.eu/rest/v2/all?fields=name";
    let response = await fetch(url);

    // If reponse exists and has a ok status
    if (response && response.ok) {
      // parse the response to json
      return await response
        .json()
        .then((res) => {
          // then get the filtered countries
          return filter_countries_by_character(res);
        })
        .then((countries) => {
          // then hide loader text
          document.querySelector(".loader").style.display = "none";

          // Get <ul> element
          let categoryList = document.querySelector("ul.categories");

          // Map through the filtered countries and append to the ul element
          countries.map((country) => {
            categoryList.innerHTML += `<li>${country.name}</li>`;
          });
        });
    } else {
      alert("HTTP-Error: " + response.status);
    }
  } catch (error) {
    alert(error);
  }
};

const filter_countries_by_character = (response, begin = "a", end = "a") => {
  // Gaurd Clauses
  // Check if the required parameter exists and if it is a object
  if (!response || typeof response !== "object") {
    console.log("Required parameter needs to be a object");
    return;
  }

  // Check if optional parameters is great than a single character and if it is not a string
  if (typeof begin !== "string" || typeof end !== "string") {
    console.log("filter_countries_by_character() only accepts strings");
    return;
  }

  if (begin.length > 1 || end.length > 1) {
    console.log(
      "filter_countries_by_character() optional parameters cannot be greater than a single character"
    );
    return;
  }
  // End Gaurd Clauses

  begin = begin.toLowerCase();
  end = end.toLowerCase();

  // Filter through Object and return any countries where the first and last characters match the input
  const filterCountries = response.filter((e) => {
    const countryName = e.name.toLowerCase();
    const firstCharacter = countryName.charAt(0);
    const lastCharacter = countryName.charAt(countryName.length - 1);

    if (firstCharacter === begin && lastCharacter === end) {
      return e;
    }
  });

  return filterCountries;
};

// Document Ready
(function () {
  // After page has loaded. Run fetch_countries();
  fetch_countries();
})();
