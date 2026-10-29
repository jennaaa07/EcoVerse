// community.js

const ecoChallenges = [
    "Today's Challenge: Bring a reusable water bottle everywhere you go!",
    "Today's Challenge: Unplug electronic devices when not in use for 2 hours.",
    "Today's Challenge: Pick up 3 pieces of litter during your commute.",
    "Today's Challenge: Opt for a meat-free meal for lunch or dinner.",
    "Today's Challenge: Use public transport or walk instead of driving today."
];

function generateEcoChallenge() {
    const challengeTextElem = document.getElementById('challengeText');
    const randomIndex = Math.floor(Math.random() * ecoChallenges.length);
    
    // Add a quick visual transition effect
    challengeTextElem.style.opacity = '0.3';
    setTimeout(() => {
        challengeTextElem.innerText = ecoChallenges[randomIndex];
        challengeTextElem.style.opacity = '1';
    }, 150);
}

function joinCampaign(campaignName) {
    alert(`Successfully joined the campaign: "${campaignName}"! Check your events list for details.`);
}